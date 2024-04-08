<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\ProductVariants;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductVariantsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $product = Product::findOrFail(request()->product);

        return $user->vendor->id === $product->vendor_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProductVariants $productVariants)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        $product = Product::findOrFail(request()->product);

        return $user->vendor->id === $product->vendor_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProductVariants $productVariants): bool
    {
        return $user->vendor->id === $productVariants->product->vendor_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProductVariants $productVariants): bool
    {
        return $user->vendor->id === $productVariants->product->vendor_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProductVariants $productVariants)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProductVariants $productVariants)
    {
        //
    }
}
