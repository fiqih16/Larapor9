<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @OA\Schema(
 *  title="User",
 *  description="User model",
 *  @OA\Xml(
 *      name="User"
 *  )
 * )
 */
class User extends Authenticatable
{
    /**
     * @OA\Property(
     *  title="id",
     *  description="id",
     *  example="1"
     * )
     *
     * @var integer
     */
    private $id;

    /** @OA\Property(
     *  title="name",
     *  description="name",
     *  example="fiqih"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *  title="email",
     * description="email",
     * example="fiqih1666@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *  title="password",
     * description="password",
     * example="password"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *  title="created_at",
     *  description="created_at",
     *  example="2021-05-01 00:00:00"
     * )
     * @var string
     */
    private $created_at;



    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

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
    ];

    public function portofolio()
    {
        return $this->hasMany(Portofolio::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function sosmed_link()
    {
        return $this->belongsTo(SosmedLink::class);
    }
}