<?php

namespace App\Http\Controllers\News;

use App\Models\User;
use App\Models\Gallery;
use App\Models\detail;
use App\Models\Banner;
use App\Models\Machineservice;
use App\Models\Scolink;
use App\Models\home;
use App\Models\social;
use App\Models\about;
use App\Models\service;
use App\Models\soloblog;
use Illuminate\Support\Facades\Log; // Don't forget to import the Log facade
use Illuminate\Support\Carbon;


use App\Models\contacts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mailstores;
use App\Models\Blogsco;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class NewsController1 extends Controller
{
     

    public function index()
    {
        $data['getRecord'] = Blogsco::paginate(9); 
        // dd($data['getRecord']);
        return view('news.index', $data);
    }
    
    public function singlepage()
    {
        return view('news.singlepage');
    }
    public function contact()
    {
        return view('news.contact');
    }
//     public function about()
//     {
//         $data['about']= about::get();
//         $data['link'] = Scolink::get();
//         $data['service'] = Machineservice::where('is_service', 0)->get();
//         return view('machine.about', $data);
//     }
//     public function service()
//     {
//         $data['content'] = Machineservice::where('is_service', 0)->get();
//         $cacheKey = 'machineservice_is_service_1';
    
//         // Attempt to retrieve data from the cache
//         $data['service'] = Cache::remember($cacheKey, now()->addHours(1), function () use ($cacheKey) {
//             // Log that a cache miss occurred and data is being fetched from the database
//             Log::info("Cache miss for key: {$cacheKey}. Fetching from database.");
//             return Machineservice::where('is_service', 1)->get();
//         });
    
//         // Additional data fetching
//         $data['serviceseo'] = service::get();
//         $data['link'] = Scolink::get();
    
//         return view('machine.service', $data);
//     }

//     public function blog()
//     {
//         // Check if the cache key exists
//         $cacheKey = 'cached_get_record';
//         $cachedTimestamp = Cache::get('cached_get_record_timestamp');
    
//         // Fetch the latest timestamp from the database
//         $latestTimestamp = Blogsco::latest('updated_at')->pluck('updated_at')->first();
    
//         // If there is no cached timestamp or if the latest timestamp is different from the cached one
//         if (!$cachedTimestamp || $latestTimestamp != $cachedTimestamp) {
//             // Fetch data from the database
//             $getRecord = Blogsco::select('id','title', 'description', 'image', 'slug')->get()->map(function ($item) {
//                 $item->slug = str_replace(' ', '-', $item->slug);
//                 return $item;
//             });
    
//             // Cache the data and update the timestamp
//             Cache::forever($cacheKey, $getRecord);
//             Cache::forever('cached_get_record_timestamp', $latestTimestamp);
    
//             // Assign the data to the $data array
//             $data['getRecord'] = $getRecord;
//         } else {
//             // If the cached data is up to date, retrieve it from the cache
//             $data['getRecord'] = Cache::get($cacheKey);
//         }
    
//         // Fetch other data that you want to include in the view
//         $data['blogseo'] = soloblog::get();
//         $data['link'] = Scolink::get();
    
//         // Return the view with the $data array
//         return view('machine.blog', $data);
//     }
    
//     public function updateDatabase()
// {
//     // Perform the database update

//     // Clear the cache for the 'getRecord' data
//     $cacheKey = 'cached_get_record';
//     Cache::forget($cacheKey);
// }

    
    
//     public function contact()
//     {
//         $data['contact'] = contacts::get();
//         $data['link'] = Scolink::get();

//         return view('machine.contact',$data);
//     }
//     public function singleblog()
//     {
//         return view('machine.singleblog');
//     }
//     public function admin_add()
//     {
//         $data['header_title'] = "Add Admin ";

//         return view('admin.admin.add_admin', $data);
//     }
//     public function add_admin_edit($id)
//     {
//         $data['getRecord'] = User::getSingle($id);

//         $data['header_title'] = "Edit Admin ";

//         return view('admin.admin.add_admin_edit', $data);
//     }
//     public function admin_add_update($id, Request $request)
//     {

//         request()->validate(['email' => 'required|email|unique:users,email,' . $id]);
//         // dd($request->all() );

//         $user = User::getSingle($id);
//         $user->name = $request->name;
//         $user->email = $request->email;
//         if ($request->filled('password')) {
//             $user->password = Hash::make($request->password);
//         }
//         $user->status = $request->status;
//         $user->is_admin = 1;
//         $user->role = $request->role;
//         $user->save();

//         return redirect('admin/admin/list')->with('success', 'Admin Successfully Updated');
//     }
//     public function admin_add_delete($id)
//     {


//         $user = User::getSingle($id);

//         $user->is_delete = 1;
//         $user->save();
//         return redirect()->back()->with('success', 'Admin Successfully Deleted');
//     }
//     public function add_admin_insert(Request $request)
//     {

//         request()->validate(['email' => 'required|email|unique:users']);

//         // dd($request->all() );
//         $user = new User();
//         $user->name = $request->name;
//         $user->email = $request->email;
//         if (!empty($request->password)) {
//             $user->password = Hash::make($request->password);
//         }

//         $user->status = $request->status;
//         $user->is_admin = 1;
//         $user->role = $request->role;
//         $user->save();

//         return redirect('admin/admin/list')->with('success', 'Admin Successfully Created');
//     }
//     public function get_logo1()
//     {
//         try {
//             $logo = Gallery::first();
//             // dd($logo);
//             if ($logo) {
//                 $image = asset('public/images/' . $logo->image);
//                 return response()->json(['image' => $image]);
//                 // dd($logo);

//             } else {
//                 return response()->json(['error' => 'No record found in the Gallery table']);
//             }
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Internal Server Error']);
//         }
//     }
//     public function store(Request $request)
//     {
//         // Extract form data
//         //  dd($request->all());
//         $name = $request->input('name');
//         $phone = $request->input('phone');
//         $message = $request->input('msg');

//         // Create a new record in the database
//         Mailstores::create([
//             'name' => $name,
//             'phone' => $phone,
//             'msg' => $message,
//         ]);

//         // Redirect or return a response
//         return redirect('/contact')->with('success', 'Message sent successfully');
//     }
//     public function get_profile()
//     {
//         try {
//             $profile = detail::first();
//             // dd($logo);
//             if ($profile) {
//                 //  $image = asset('public/images/' . $logo->image);
//                 return response()->json(['profile' => $profile]);
//                 // dd($logo);

//             } else {
//                 return response()->json(['error' => 'No record found in the Gallery table']);
//             }
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Internal Server Error']);
//         }
//     }
//     public function get_service()
//     {
//         try {
//             $service = Machineservice::where('is_service', 1)->get();
//             // dd($logo);
//             if ($service) {
//                 //  $image = asset('public/images/' . $logo->image);
//                 return response()->json(['service' => $service]);
//                 // dd($logo);

//             } else {
//                 return response()->json(['error' => 'No record found in the Gallery table']);
//             }
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Internal Server Error']);
//         }
//     }
//     public function get_blog(Request $request, $id)
//     {
//         $data['link'] = Scolink::get();
    
//         // Find the blog record with the given ID
//         $data['getRecord3'] = Blogsco::get()->map(function ($item) {
//             $item->slug = str_replace(' ', '-', $item->slug);
//             return $item;
//         });
//         $data['getRecord'] = Blogsco::find($id);
//         if ($data['getRecord']) {
//             $data['getRecord']->slug = str_replace(' ', '-', $data['getRecord']->slug);
//         }
//         // $data['blog'] = Blogsco::find($id);
//         $blog = Blogsco::find($id);
    
//         if ($blog) {
//             // If the blog record is found, update the ogimage property
//             $blog->ogimage = asset('public/images/' . $blog->ogimage);
        
//             // Assign the modified blog record to the 'getRecord' key in the data array
//             $data['getRecord5'] = $blog;
//             // dd($data['getRecord']);
//         } else {
//             // If the blog record is not found, set $getRecord to null
//             $data['getRecord5'] = null;
//         }
//             //  dd($data['getRecord5']);
        
    
//         // Return the view with the data array
//         return view('machine.singleblog', $data);
//     }
    



//     public function get_all()
//     {
//         try {
//             $home = home::get();
//             $link = Scolink::get();
//             $sociallink = social::where('is_social', 0)->get();
//             $gather = social::where('is_social', 1)->get();
//             $about = about::get();
//             $blog = soloblog::get();
//             $service = service::get();
//             $contact = contacts::get();

//             return response()->json([
//                 'home' => $home,
//                 'link' => $link,
//                 'sociallink' => $sociallink,
//                 'gather' => $gather,
//                 'about' => $about,
//                 'blog' => $blog,
//                 'service' => $service,
//                 'contact' => $contact

//             ]);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Internal Server Error']);
//         }
//     }
}
