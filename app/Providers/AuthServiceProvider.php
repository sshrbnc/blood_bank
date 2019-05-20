<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 5, 6]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Profile
        Gate::define('profile_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('profile_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('profile_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('profile_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('profile_delete', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Blog
        // Gate::define('blog_access', function ($user) {
        //     return in_array($user->role_id, [1]);
        // });
        // Gate::define('blog_create', function ($user) {
        //     return in_array($user->role_id, [1]);
        // });
        // Gate::define('blog_edit', function ($user) {
        //     return in_array($user->role_id, [1]);
        // });
        // Gate::define('blog_view', function ($user) {
        //     return in_array($user->role_id, [1]);
        // });
        // Gate::define('blog_delete', function ($user) {
        //     return in_array($user->role_id, [1]);
        // });

        //Auth gates for: Donor
        Gate::define('donor_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 4, 5]);
        });
        Gate::define('donor_create', function ($user) {
            return in_array($user->role_id, [1, 3, 5]);
        });
        Gate::define('donor_edit', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 4, 5]);
        });
        Gate::define('donor_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 4, 5]);
        });
        Gate::define('donor_delete', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        //Auth gates for: Patient
        Gate::define('patient_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 6]);
        });
        Gate::define('patient_create', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 6]);
        });
        Gate::define('patient_edit', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('patient_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('patient_delete', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        //Auth gates for: Blood Request
        Gate::define('blood_request_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 5, 6]);
        });
        Gate::define('blood_request_create', function ($user) {
            return in_array($user->role_id, [1, 2, 3, 5, 6]);
        });
        Gate::define('blood_request_edit', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('blood_request_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('blood_request_delete', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });

        //Auth gates for: Donor's Name Access
        Gate::define('donor_name_access', function ($user) {
            return in_array($user->role_id, [1, 3, 5]);
        });

        //Auth gates for: Details Information
        Gate::define('details_information_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4, 6]);
        }); 

        //Auth gates for: Donor ID Access
        Gate::define('donor_id_access', function ($user) {
            return in_array($user->role_id, [2, 4]);
        }); 

        //Auth gates for: Blood
        Gate::define('blood_access', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        }); 
        Gate::define('blood_create', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('blood_edit', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('blood_view', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });
        Gate::define('blood_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        //View Donor's Donation Weight and Blood Count
        Gate::define('donation_w_bc', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        //Donation
        Gate::define('donation_delete', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });

        //Flag
        Gate::define('can_see_flag', function ($user) {
            return in_array($user->role_id, [1, 3, 4]);
        });

        //View Employee who edited's Name
        Gate::define('see_employee_name', function ($user) {
            return in_array($user->role_id, [1, 3]);
        });
    }
}
