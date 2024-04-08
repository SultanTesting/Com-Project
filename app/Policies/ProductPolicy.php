<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): Response
    {
        return $user->vendor->id === $product->vendor_id
               ? Response::allow()
               : Response::deny('Oops, Not Found');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->block !== 'block';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): Response
    {
        return $user->vendor->id === $product->vendor_id
               ? Response::allow()
               : Response::deny('Oops, Not Found');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): Response
    {
        return $user->vendor->id === $product->vendor_id
               ? Response::allow()
               : Response::deny('You Are Not Allowed!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
