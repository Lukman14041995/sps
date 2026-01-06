<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'position',
        'department',
        'description',
        'requirements',
        'employment_type',
        'location',
        'salary_min',
        'salary_max',
        'application_deadline',
        'is_active',
        'vacancies',
        'experience_required',
        'benefits',
    ];

    protected $casts = [
        'application_deadline' => 'date',
        'is_active' => 'boolean',
        'benefits' => 'array',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function getEmploymentTypeLabelAttribute()
    {
        return [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'contract' => 'Contract',
            'internship' => 'Internship',
        ][$this->employment_type] ?? $this->employment_type;
    }

    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . ' - Rp ' . number_format($this->salary_max, 0, ',', '.');
        } elseif ($this->salary_min) {
            return 'Rp ' . number_format($this->salary_min, 0, ',', '.') . '+';
        } elseif ($this->salary_max) {
            return 'Up to Rp ' . number_format($this->salary_max, 0, ',', '.');
        }
        return 'Negotiable';
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>'
            : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>';
    }

    public function getFormattedDeadlineAttribute()
    {
        return $this->application_deadline->format('M d, Y');
    }

    public function getDaysRemainingAttribute()
    {
        $now = now();
        $deadline = $this->application_deadline;

        if ($deadline->lessThan($now)) {
            return 'Closed';
        }

        return $deadline->diffInDays($now) . ' days remaining';
    }
}
