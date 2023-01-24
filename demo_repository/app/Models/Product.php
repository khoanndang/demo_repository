<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   description="Product model",
 *   title="Product2",
 *   required={},
 *   @OA\Property(type="integer",description="id of Product",title="id",property="id",example="1",readOnly="true"),
 *   @OA\Property(type="string",description="name of Product",title="product_name",property="product_name",example="Macbook Pro"),
 *   @OA\Property(type="status",description="status of Product",title="status",property="status",example="sold"),
 *   @OA\Property(type="dateTime",title="created_at",property="created_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 *   @OA\Property(type="dateTime",title="updated_at",property="updated_at",example="2022-07-04T02:41:42.336Z",readOnly="true"),
 * )
 * 
 * @OA\Schema(
 *   schema="Products",
 *   title="Products",
 *   @OA\Property(title="data",property="data",type="array",
 *     @OA\Items(type="object",ref="#/components/schemas/Product"),
 *   )
 * )
 * 
 * @OA\Parameter(
 *      parameter="Product--id",
 *      in="path",
 *      name="Product_id",
 *      required=true,
 *      description="Id of Product",
 *      @OA\Schema(
 *          type="integer",
 *          example="1",
 *      )
 * ),
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'status'
    ];

    protected $table = 'products';


}
