<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $matricule
 * @property string $nom
 * @property string $prenom
 */
class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['matricule', 'nom', 'prenom'];
}
