<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\ProductVariantItem;
use App\Models\ProductVariants;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductVariantItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        $product = Product::findOrFail(request()->product);
        $variant = ProductVariants::findOrFail(request()->variant);

        return $user->vendor->id === $product->vendor_id && $user->vendor->id === $variant->product->vendor_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProductVariantItem $productVariantItem)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $variant = ProductVariants::findOrFail(request()->variant);
        $product = Product::findOrFail(request()->product);

        return $user->vendor->id == $product->vendor_id;

        // return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProductVariantItem $productVariantItem): bool
    {
        return $user->vendor->id === $productVariantItem->variant->product->vendor_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProductVariantItem $productVariantItem): bool
    {
        return $user->vendor->id === $productVariantItem->variant->product->vendor_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProductVariantItem $productVariantItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProductVariantItem $productVariantItem)
    {
        //
    }
}
