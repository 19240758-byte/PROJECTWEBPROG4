<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDestinationController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminGuideController;
use App\Http\Controllers\AdminEquipmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileWisatawanController;
use App\Models\Destination;
use App\Models\User;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout!');
    })->name('logout');
});

// Public Routes
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
Route::get('/packages', [BookingController::class, 'create'])->name('packages.create');

// Protected Booking Routes
Route::middleware('auth')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Guide & Renter Dashboard
Route::middleware('auth')->group(function () {
    Route::get('/guide/bookings', [DashboardController::class, 'guideBookings'])->name('guide.bookings');
    Route::patch('/guide/bookings/{booking}/approve', [DashboardController::class, 'approveBooking'])->name('guide.bookings.approve');
    Route::patch('/guide/bookings/{booking}/reject', [DashboardController::class, 'rejectBooking'])->name('guide.bookings.reject');
});
// Auth Routes
Route::get('/login', function() {
    return view('auth.login');
})->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', function() {
    return view('auth.register');
})->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
// SUPER ADMIN DASHBOARD
Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // DESTINASI CRUD
    Route::resource('destinations', AdminDestinationController::class);

    // GUIDE CRUD
    Route::resource('guides', AdminGuideController::class);

    // EQUIPMENT CRUD
    Route::resource('equipments', AdminEquipmentController::class);
});
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('destinations', AdminDestinationController::class);
    Route::resource('guides', AdminGuideController::class);
    Route::resource('equipments', AdminEquipmentController::class);
});
// 🔥 SUPER ADMIN - HARUS PAKAI 'admin' middleware
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('destinations', AdminDestinationController::class);
    Route::resource('guides', AdminGuideController::class);
    Route::resource('equipments', AdminEquipmentController::class);
});
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Destinations
    Route::resource('destinations', AdminDestinationController::class);
    Route::patch('destinations/{destination}/photo', [AdminDestinationController::class, 'updatePhoto'])->name('destinations.update-photo');  // ← INI!

    // Guides & Equipments
    Route::resource('guides', AdminGuideController::class);
    Route::resource('equipments', AdminEquipmentController::class);
});
Route::middleware(['auth', 'role:guide'])->group(function () {
    // Rute lainnya...
    //Route::get('/guide/income/export', [DashboardController::class, 'exportIncome'])->name('guide.income.export');
});
Route::post('/bookings/{booking}/approve', [DashboardController::class, 'approveBooking'])->name('bookings.approve');
Route::patch('/guide/bookings/{booking}/approve', [DashboardController::class, 'approveBooking'])->name('bookings.approve');
//Route::resource('admin/guides', GuideController::class)->middleware('auth');
//Route::get('/admin/dashboard', [AdminGuideController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/', [AdminGuideController::class, 'welcome'])->name('home');
// REDIRECT DASHBOARD BERDASARKAN ROLE
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'guide') {
            return redirect()->route('guide.bookings');
        }

        return app(DashboardController::class)->index(); // Tourist
    })->name('dashboard');

    Route::post('/logout', function() {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout!');
    })->name('logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');


// --- KHUSUS GUIDE (MANAJEMEN BOOKING) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/guide/bookings', [DashboardController::class, 'guideBookings'])->name('guide.bookings');
   Route::post('/guide/bookings/{booking}/approve', [DashboardController::class, 'approveBooking'])->name('guide.bookings.approve');
    Route::post('/guide/bookings/{booking}/reject', [DashboardController::class, 'rejectBooking'])->name('guide.bookings.reject');
    Route::get('/income/export-pdf', [App\Http\Controllers\IncomeController::class, 'exportPdf'])
    ->name('guide.income.export_pdf')
    ->middleware(['auth', 'role:guide']);
});
// Rute untuk menampilkan halaman daftar
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');

// Rute untuk memproses data pendaftaran
Route::post('/register', [RegisteredUserController::class, 'register'])->name('register.store');

//Route::get('/', function () {

    //$guides = User::where('role', 'guide')->get();

    //$destinations = Destination::latest()->get();

    //return view('welcome', compact('guides', 'destinations'));

//});
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Route untuk halaman Daftar Guide (yang datanya sudah benar)
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route untuk kelola peralatan
    Route::resource('equipments', AdminEquipmentController::class);
});

// Route untuk Katalog User (Tampilan Card)
Route::get('/sewa-alat', [EquipmentController::class, 'Index'])->name('equipments.index');

// Route Group untuk Admin (Tampilan Tabel & Pengelolaan)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Jalur utama untuk Simpan, Edit, dan Hapus
    Route::resource('admin.equipments.index', EquipmentController::class);
});
// Ini rute yang paling penting agar sinkron. Harus lewat Controller!
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Daftar Semua Alat (Halaman Sewa Alat)
Route::get('/equipments', [EquipmentController::class, 'index'])->name('equipments.index');
// Tambahkan rute ini di dalam file web.php
Route::get('/incomes/print/{id}', [IncomeController::class, 'print'])->name('incomes.print');

Route::middleware(['auth'])->group(function () {
    // Halaman utama daftar ulasan
    Route::get('/Dashboard/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    // Proses simpan ulasan
    Route::post('/Dashboard/reviews/{id}', [ReviewController::class, 'store'])->name('reviews.store');
});
// Route untuk melihat daftar semua guide
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');

// Route baru untuk melihat detail profil satu guide menggunakan parameter ID
Route::get('/guides/{id}', [GuideController::class, 'show'])->name('guides.show');


Route::get('/destination', [DestinationController::class, 'index'])->name('destination.index');
Route::get('/destination/{id}', [DestinationController::class, 'show'])->name('destination.show');




// Route untuk halaman khusus menampilkan semua riwayat trip user
Route::get('/dashboard/trips', [App\Http\Controllers\DashboardController::class, 'tripHistory'])->name('trips.index');

Route::middleware(['auth'])->group(function () {
    // Pastikan rute ini ada dan memiliki nama 'messages.index'
    Route::get('/dashboard/messages', [ChatController::class, 'index'])->name('messages.index');

    // Rute untuk menangani pengiriman pesan
    Route::post('/dashboard/messages/send', [ChatController::class, 'sendMessage'])->name('messages.send');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/profile', [ProfileWisatawanController::class, 'index'])->name('profile.index');
    Route::put('/dashboard/profile/update', [ProfileWisatawanController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth'])->group(function () {
    // Pastikan URL-nya '/dashboard/messages' dan namanya 'messages.index'
    Route::get('/dashboard/messages', [App\Http\Controllers\ChatController::class, 'index'])->name('messages.index');
});


// Pastikan name('guide.') ditulis TUNGGAL tanpa huruf s
Route::middleware(['auth'])->prefix('guide')->name('guide.')->group(function () {

    // Ini jalur untuk MEMBUKA halaman chat (index)
    Route::get('/messages', [ChatController::class, 'index'])->name('messages.index');

    // Ini jalur untuk MEMPROSES pengiriman chat (store) - mesin belakang layar
    Route::post('/messages/store', [ChatController::class, 'store'])->name('messages.store');

});

Route::middleware(['auth'])->prefix('guide')->name('guide.')->group(function () {

    // MENGARAH KE CONTROLLER BARU:
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    // Rute lainnya tetap biarkan sementara
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    Route::get('/profile', function () { return 'Halaman Profil - Segera Datang!'; });
});
Route::middleware(['auth'])->group(function () {


    // TAMBAHKAN RUTE INI:
    Route::get('/dashboard/reviews', [ReviewController::class, 'touristIndex'])->name('tourist.reviews.index');
Route::post('/dashboard/reviews/store/{id}', [ReviewController::class, 'store'])->name('tourist.reviews.store');
// 1. RUTE UNTUK MENAMPILKAN HALAMAN TABEL RIWAYAT PEMESANAN
    // Rute ini yang bertugas mengambil data $bookings dan merender halaman index tabel kemarin
    Route::get('/dashboard/booking', [App\Http\Controllers\ReviewController::class, 'touristBookingIndex'])->name('tourist.booking.index');

    // 2. RUTE UNTUK MENAMPILKAN HISTORY ULASAN SAYA
    Route::get('/dashboard/booking', [ReviewController::class, 'touristBookingIndex'])->name('tourist.booking.index');

    // 3. RUTE POST UNTUK PROSES SIMPAN ULASAN DARI MODAL POP-UP
    Route::post('/dashboard/booking/store/{id}', [ReviewController::class, 'store'])->name('tourist.booking.store');
});
