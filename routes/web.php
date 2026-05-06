    <?php

    use Illuminate\Support\Facades\Route;
    use League\CommonMark\Environment\Environment;
    use App\Http\Controllers\Admin\AuthController;
    use App\Http\Controllers\Admin\BlogController;
    use App\Http\Controllers\Admin\ContactController;
    use App\Http\Controllers\Admin\GalleryController;
    use App\Http\Controllers\Admin\ProgramController;
    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\TestimonialController;
    use App\Http\Controllers\HomeController;

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
    Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
    Route::get('/blogs', [HomeController::class, 'blog'])->name('blog');
    Route::get('/programs', [HomeController::class, 'program'])->name('program');
    Route::get('programs/{slug}', [HomeController::class, 'programDetail'])->name('program.detail');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact/store', [HomeController::class, 'contactStore'])->name('contact.store');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');

        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
            Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
            Route::get('/settings', [AuthController::class, 'settings'])->name('settings');
            Route::post('/settings/update', [AuthController::class, 'updateSettings'])->name('settings.update');

            Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
            Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create');
            Route::post('programs/store', [ProgramController::class, 'store'])->name('programs.store');
            Route::get('programs/edit/{id}', [ProgramController::class, 'edit'])->name('programs.edit');
            Route::put('programs/update/{id}', [ProgramController::class, 'update'])->name('programs.update');
            Route::delete('programs/delete/{id}', [ProgramController::class, 'destroy'])->name('programs.destroy');

            Route::get('gallery',                      [GalleryController::class, 'index'])->name('gallery.index');
            Route::get('gallery/create',               [GalleryController::class, 'create'])->name('gallery.create');
            Route::post('gallery/store',               [GalleryController::class, 'store'])->name('gallery.store');
            Route::get('gallery/edit/{id}',            [GalleryController::class, 'edit'])->name('gallery.edit');
            Route::post('gallery/update/{id}',         [GalleryController::class, 'update'])->name('gallery.update');
            Route::get('gallery/destroy/{id}',         [GalleryController::class, 'destroy'])->name('gallery.destroy');
            Route::get('gallery/toggle-status/{id}',   [GalleryController::class, 'toggleStatus'])->name('gallery.toggle.status');
            Route::get('gallery/image/delete/{id}',    [GalleryController::class, 'deleteImage'])->name('gallery.image.delete');

            Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
            Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
            Route::post('testimonials/store', [TestimonialController::class, 'store'])->name('testimonials.store');
            Route::get('testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonials.edit');
            Route::put('testimonials/update/{id}', [TestimonialController::class, 'update'])
                ->name('testimonials.update');
            Route::delete('testimonials/delete/{id}', [TestimonialController::class, 'destroy'])
                ->name('testimonials.destroy');

            Route::get('testimonialshome', [TestimonialController::class, 'homeindex'])->name('testimonialshome.index');
            Route::get('testimonialshome/create', [TestimonialController::class, 'homecreate'])->name('testimonialshome.create');
            Route::post('testimonialshome/store', [TestimonialController::class, 'homestore'])->name('testimonialshome.store');
            Route::get('testimonialshome/edit/{id}', [TestimonialController::class, 'homeedit'])->name('testimonialshome.edit');
            Route::put('testimonialshome/update/{id}', [TestimonialController::class, 'homeupdate'])
                ->name('testimonialshome.update');
            Route::delete('testimonialshome/delete/{id}', [TestimonialController::class, 'homedestroy'])
                ->name('testimonialshome.destroy');

            Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::get('categories/status/{id}', [CategoryController::class, 'toggleStatus'])->name('categories.status');


            Route::get('/contact/list', [ContactController::class, 'index'])->name('contact.index');
            Route::delete('/contact/delete/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

            Route::prefix('admin')->group(function () {
                Route::resource('blogs', BlogController::class);
            });
        });
    });
