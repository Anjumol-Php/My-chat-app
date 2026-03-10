<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // ഏത് കോളങ്ങളാണ് സേവ് ചെയ്യാൻ അനുവദിക്കേണ്ടത് എന്ന് ഇവിടെ കൊടുക്കണം
    protected $fillable = ['title', 'completed','image'];
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}