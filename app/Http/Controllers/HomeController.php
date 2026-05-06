<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Testimonial_homes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->limit(3)->get();
        $testimonials = Testimonial_homes::where('status', 1)->latest()->get();
        return view('frontend.index', compact('blogs','testimonials'));
    }

    public function about()
    {
        return view('frontend.about');
    }


    public function testimonial()
    {
        $testimonials = Testimonial::where('status', 1)->latest()->get();
        return view('frontend.testimonial', compact('testimonials'));
    }


    // public function programs()
    // {
    //     $categories = Category::where('status', 1)->get();
    //     return view('frontend.our-program', compact('categories'));
    // }




    public function program()
    {
        // Get all categories
        $categories = Category::all();
        return view('frontend.our-program', compact('categories'));
    }

    // Program detail page — show programs under a category
    public function programDetail($slug)
    {
        // Get category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Get programs under this category
        $programs = Program::where('category_id', $category->id)->get();

        return view('frontend.program-details', compact('category', 'programs'));
    }

    public function gallery()
    {
        // ✅ Fetch all galleries dynamically with their images
        $galleries = Gallery::with('images')->get();

        // ✅ Flat collection of ALL images for the top slider
        $allImages = $galleries->flatMap(fn($gallery) => $gallery->images);

        // ✅ Key by section_key for named access
        $sections = $galleries->keyBy('section_key');

        $slider        = $sections->get('slider');
        $international = $sections->get('international');
        $outstation    = $sections->get('outstation');
        $edufun        = $sections->get('edufun');
        $dayouting     = $sections->get('dayouting');

        return view('frontend.gallery', compact(
            'galleries',
            'allImages',
            'slider',
            'international',
            'outstation',
            'edufun',
            'dayouting'
        ));
    }



    // public function gallery(){
    //     $galleries = Gallery::with('details')->where('status',1)->get();
    //     return view('frontend.gallery-list', compact('galleries'));
    // }

    // public function galleryList($slug){
    //     $gallery = Gallery::with('details')->where('slug', $slug)->where('status', 1)->first();
    //     return view('frontend.gallery', compact('gallery'));
    // }

    // public function blog(){
    //     $blogs = Blog::where('status', 1)->get();
    //     return view('frontend.blog', compact('blogs'));
    // }

    // public function blogDetail($slug){
    //     $blog = Blog::where('slug', $slug)->first();
    //     $latest_blogs = Blog::where('status', 1)->whereNotIn('id', [$blog->id])->latest()->limit(6)->get();
    //     $tags = Blog::where('status', 1)->inRandomOrder()->limit(3)->get();
    //     return view('frontend.blog-detail', compact('blog','latest_blogs','tags'));
    // }

    public function contact()
    {
        return view('frontend.contact');
    }

    // public function contactStore(Request $r)
    // {
    //     $r->validate([
    //         'name'   => 'required|string|max:100',
    //         'subject'   => 'required|string|max:100',
    //         'email'   => 'required|email|max:150',
    //         'message' => 'nullable|string|max:500',
    //     ]);

    //     // Store Data
    //     $contact = Contact::create([
    //         'name'   => $r->name,
    //         'subject'   => $r->subject,
    //         'email'   => $r->email,
    //         'message' => $r->message,
    //     ]);

    //     try {
    //         Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
    //             $message->to('kavinwebbitech@gmail.com')
    //                 ->replyTo($contact->email, $contact->fname)
    //                 ->subject('New Contact Form Submission');
    //         });
    //     } catch (Exception $e) {
    //         Log::info('Mail send Failed :' . $e->getMessage());
    //     }

    //     // Redirect with success message
    //     return redirect()->back()->with('success', 'Message submitted successfully!');
    // }

    public function contactStore(Request $r)
    {
        $validated = $r->validate([
            'name'    => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'message' => 'nullable|string|max:500',
        ]);

        // ✅ Store Correct Fields
        $contact = Contact::create([
            'name'    => $r->name,
            'subject' => $r->subject,
            'email'   => $r->email,
            'message' => $r->message,
        ]);

        // ✅ Send Mail
        try {
            Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
                $message->to('kavinwebbitech@gmail.com')
                    ->replyTo($contact->email, $contact->name)
                    ->subject('New Contact Form Submission');
            });
        } catch (\Exception $e) {
            Log::info('Mail send Failed: ' . $e->getMessage());
        }

        // ✅ RETURN JSON (IMPORTANT for AJAX)
        return response()->json([
            'status' => true,
            'message' => 'Message submitted successfully!'
        ]);
    }
}
