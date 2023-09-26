<?php

namespace App\Models;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
 * User Model
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Collection $tasks
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Boot method for the User model.
     *
     * This method is called when the User model is booted. It sets up event listeners
     * to perform actions when a user is created or deleted, such as sending a welcome email
     * on user creation and deleting associated tasks on user deletion.
     */
    protected static function boot(): void
    {
        parent::boot();
        //Sends a welcome email when a user is created
        static::created(fn (User $user) => SendWelcomeEmail::dispatch($user));
        // Delete tasks related to the user being deleted
        static::deleting(fn (User $user) => $user->tasks()->delete());
    }

    /**
     * Define the password attribute.
     *
     * This method defines the behavior of the 'password' attribute,
     * including how it is retrieved and set (hashed).
     *
     * @return Attribute
     */
    public function password(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value,
            set: fn (string $value) => bcrypt($value),
        );
    }

    /**
     * Define the relationship between User and Task models.
     *
     * This method defines the 'tasks' relationship, specifying that a User has many Task records.
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Resolve route model binding for the logged-in user.
     *
     * This method resolves route model binding for the logged-in user when using
     * the `Auth::id()` as the binding value.
     *
     * @param mixed $value
     * @param string|null $field
     * @return Model|Relation|null
     */
    public function resolveRouteBinding($value, $field = null): Model|Relation|null
    {
        return $this->resolveRouteBindingQuery($this, Auth::id(), $field)->first();
    }
}
