<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Certificate
 * @package App\Models
 * @property User[] users
 * @property string name
 * @property boolean is_visible
 */
class Certificate extends Model
{
    use HasFactory;
    protected $fillable=['name','is_visible'];
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_certificates',  'certificate_id','user_id');
    }
}
