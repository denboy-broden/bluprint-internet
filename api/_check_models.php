<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$models = ["Customer","Service","Package","Lead","Campaign","Invoice","InvoiceItem","Payment","Pop","Olt","Router","Ont","Technician","Ticket","Incident","WorkOrder","Product","Warehouse","Stock","Supplier","PurchaseOrder","Asset","BankAccount","CashTransaction","ChartOfAccount","JournalEntry","JournalLineItem","Employee","AuditLog"];

foreach ($models as $m) {
    $cls = "App\\Models\\" . $m;
    try {
        $instance = new $cls;
        echo "$m -> table[" . $instance->getTable() . "] fillable[" . count($instance->getFillable()) . "] OK\n";
    } catch (\Throwable $e) {
        echo "$m -> ERROR: " . $e->getMessage() . "\n";
    }
}
