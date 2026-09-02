# Phase 3 — Laravel Implementation Files

Status: Laravel 11 project dibuat di `C:\ai_agent\blueprint\api\`. File-file di bawah ini tinggal di-copy ke folder yang sesuai.

## 1. Customer Model — `api/app/Models/Customer.php`
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'customer_id', 'full_name', 'phone', 'email',
        'id_number', 'address', 'address_lat', 'address_lng',
        'status', 'package_id',
    ];

    protected $casts = [
        'status' => 'string',
        'address_lat' => 'decimal:8',
        'address_lng' => 'decimal:8',
    ];

    public function services(): HasMany { return $this->hasMany(Service::class); }
    public function tickets(): HasMany { return $this->hasMany(Ticket::class); }
}
```

## 2. CustomerController — `api/app/Http/Controllers/Api/V1/CustomerController.php`
```php
<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Customer::query();
        if ($request->filled('status')) $query->where('status', $request->status);
        $customers = $query->paginate(20);
        return response()->json($customers);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:customers,email',
            'address' => 'nullable|string',
            'status' => 'nullable|in:LEAD,PROSPECT,ACTIVE,SUSPENDED,TERMINATED',
        ]);
        $validated['customer_id'] = 'CUST-' . strtoupper(substr(uniqid(), -8));
        $customer = Customer::create($validated);
        return response()->json(['message' => 'Customer created', 'data' => $customer], 201);
    }

    public function show(Customer $customer): JsonResponse
    {
        $customer->load(['services', 'tickets']);
        return response()->json($customer);
    }

    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'email' => 'sometimes|email|unique:customers,email,' . $customer->id,
            'address' => 'nullable|string',
            'status' => 'nullable|in:LEAD,PROSPECT,ACTIVE,SUSPENDED,TERMINATED',
        ]);
        $customer->update($validated);
        return response()->json(['message' => 'Customer updated', 'data' => $customer]);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted']);
    }
}
```

## 3. Service Model — `api/app/Models/Service.php`
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'service_id', 'customer_id', 'package_id',
        'olt_id', 'ont_id', 'status', 'installed_at',
    ];
    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
}
```

## 4. Ticket Model — `api/app/Models/Ticket.php`
```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_id', 'customer_id', 'service_id', 'category',
        'priority', 'status', 'description', 'resolution_notes',
    ];
    public function customer(): BelongsTo { return $this->belongsTo(Customer::class); }
    public function service(): BelongsTo { return $this->belongsTo(Service::class); }
}
```

## 5. Routes — `api/routes/api.php` (replace entire content)
```php
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;

Route::prefix('v1')->group(function () {
    Route::get('/health', fn() => response()->json(['status' => 'ok', 'service' => 'rt-rw-net-api']));
    Route::apiResource('customers', CustomerController::class);
});
```

## 6. Bootstrap (enable API routes) — `api/bootstrap/app.php` (replace entire content)
```php
<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

## 7. .env (replace api/.env) — DB config
```env
APP_NAME="RT/RW Net API"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=rt_rw_net
DB_USERNAME=root
DB_PASSWORD=secret

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

SANCTUM_STATEFUL_DOMAINS=localhost:3000
```

## LANGKAH SETELAH COPY FILE
```powershell
cd C:\ai_agent\blueprint\api
docker run --rm -v C:/ai_agent/blueprint/api:/app composer install
docker run --rm -v C:/ai_agent/blueprint/api:/app php artisan key:generate
docker run --rm -v C:/ai_agent/blueprint/api:/app php artisan migrate
docker run --rm -v C:/ai_agent/blueprint/api:/app php artisan serve --host=0.0.0.0 --port=8000
```

## TEST
```powershell
curl http://localhost:8000/api/v1/health
curl -X POST http://localhost:8000/api/v1/customers -H "Content-Type: application/json" -d '{\"full_name\":\"Test\",\"phone\":\"081234567890\"}'
```

Catatan: `docker run --rm php artisan` akan gagal karena container php tidak punya akses ke file di host. Sebaiknya install PHP langsung ke Windows atau gunakan Laravel Sail (sudah ter-bundle).
