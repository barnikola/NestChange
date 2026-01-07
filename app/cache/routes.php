<?php return array (
  'GET' => 
  array (
    '/login' => 
    array (
      0 => 'AuthController',
      1 => 'showLogin',
    ),
    '/signin' => 
    array (
      0 => 'AuthController',
      1 => 'showLogin',
    ),
    '/auth/signin' => 
    array (
      0 => 'AuthController',
      1 => 'showLogin',
    ),
    '/auth/login' => 
    array (
      0 => 'AuthController',
      1 => 'showLogin',
    ),
    '/register' => 
    array (
      0 => 'AuthController',
      1 => 'showRegister',
    ),
    '/auth/register' => 
    array (
      0 => 'AuthController',
      1 => 'showRegister',
    ),
    '/logout' => 
    array (
      0 => 'AuthController',
      1 => 'logout',
    ),
    '/auth/logout' => 
    array (
      0 => 'AuthController',
      1 => 'logout',
    ),
    '/forgot-password' => 
    array (
      0 => 'AuthController',
      1 => 'showForgotPassword',
    ),
    '/auth/forgot-password' => 
    array (
      0 => 'AuthController',
      1 => 'showForgotPassword',
    ),
    '/reset-password' => 
    array (
      0 => 'AuthController',
      1 => 'showResetPassword',
    ),
    '/auth/reset-password' => 
    array (
      0 => 'AuthController',
      1 => 'showResetPassword',
    ),
    '/' => 
    array (
      0 => 'HomeController',
      1 => 'index',
    ),
    '/home' => 
    array (
      0 => 'HomeController',
      1 => 'index',
    ),
    '/listings' => 
    array (
      0 => 'ListingController',
      1 => 'index',
    ),
    '/listings/search' => 
    array (
      0 => 'ListingController',
      1 => 'search',
    ),
    '/listings/create' => 
    array (
      0 => 'ListingController',
      1 => 'create',
    ),
    '/listings/{id}' => 
    array (
      0 => 'ListingController',
      1 => 'show',
    ),
    '/listings/{id}/edit' => 
    array (
      0 => 'ListingController',
      1 => 'edit',
    ),
    '/my-listings' => 
    array (
      0 => 'ListingController',
      1 => 'myListings',
    ),
    '/profile' => 
    array (
      0 => 'ProfileController',
      1 => 'index',
    ),
    '/profile/edit' => 
    array (
      0 => 'ProfileController',
      1 => 'edit',
    ),
    '/profile/{id}' => 
    array (
      0 => 'ProfileController',
      1 => 'show',
    ),
    '/my-applications' => 
    array (
      0 => 'ApplicationController',
      1 => 'myApplications',
    ),
    '/received-applications' => 
    array (
      0 => 'ApplicationController',
      1 => 'receivedApplications',
    ),
    '/applications/{id}' => 
    array (
      0 => 'ApplicationController',
      1 => 'show',
    ),
    '/listings/{listingId}/apply' => 
    array (
      0 => 'ApplicationController',
      1 => 'create',
    ),
    '/applications/list.json' => 
    array (
      0 => 'ApplicationController',
      1 => 'listJson',
    ),
    '/api/listings/search' => 
    array (
      0 => 'ListingController',
      1 => 'search',
    ),
    '/notifications' => 
    array (
      0 => 'NotificationController',
      1 => 'index',
    ),
    '/chat' => 
    array (
      0 => 'ChatController',
      1 => 'index',
    ),
    '/chat/messages' => 
    array (
      0 => 'ChatController',
      1 => 'getMessages',
    ),
    '/chat/search' => 
    array (
      0 => 'ChatController',
      1 => 'search',
    ),
    '/chat/details' => 
    array (
      0 => 'ChatController',
      1 => 'getChatDetails',
    ),
    '/admin' => 
    array (
      0 => 'AdminController',
      1 => 'index',
    ),
    '/admin/dashboard' => 
    array (
      0 => 'AdminController',
      1 => 'index',
    ),
    '/admin/users' => 
    array (
      0 => 'AdminController',
      1 => 'users',
    ),
    '/admin/documents' => 
    array (
      0 => 'AdminController',
      1 => 'documents',
    ),
    '/admin/listings' => 
    array (
      0 => 'AdminController',
      1 => 'listings',
    ),
    '/moderator' => 
    array (
      0 => 'ModeratorController',
      1 => 'index',
    ),
    '/moderator/dashboard' => 
    array (
      0 => 'ModeratorController',
      1 => 'index',
    ),
    '/moderator/listings' => 
    array (
      0 => 'ModeratorController',
      1 => 'listings',
    ),
    '/moderator/documents' => 
    array (
      0 => 'ModeratorController',
      1 => 'documents',
    ),
  ),
  'POST' => 
  array (
    '/login' => 
    array (
      0 => 'AuthController',
      1 => 'login',
    ),
    '/signin' => 
    array (
      0 => 'AuthController',
      1 => 'login',
    ),
    '/auth/login' => 
    array (
      0 => 'AuthController',
      1 => 'login',
    ),
    '/register' => 
    array (
      0 => 'AuthController',
      1 => 'register',
    ),
    '/auth/register' => 
    array (
      0 => 'AuthController',
      1 => 'register',
    ),
    '/logout' => 
    array (
      0 => 'AuthController',
      1 => 'logout',
    ),
    '/forgot-password' => 
    array (
      0 => 'AuthController',
      1 => 'forgotPassword',
    ),
    '/auth/forgot-password' => 
    array (
      0 => 'AuthController',
      1 => 'forgotPassword',
    ),
    '/reset-password' => 
    array (
      0 => 'AuthController',
      1 => 'resetPassword',
    ),
    '/auth/reset-password' => 
    array (
      0 => 'AuthController',
      1 => 'resetPassword',
    ),
    '/listings/create' => 
    array (
      0 => 'ListingController',
      1 => 'store',
    ),
    '/listings/{id}/edit' => 
    array (
      0 => 'ListingController',
      1 => 'update',
    ),
    '/listings/{id}/delete' => 
    array (
      0 => 'ListingController',
      1 => 'destroy',
    ),
    '/listings/{id}/publish' => 
    array (
      0 => 'ListingController',
      1 => 'publish',
    ),
    '/listings/{id}/pause' => 
    array (
      0 => 'ListingController',
      1 => 'pause',
    ),
    '/listings/{listingId}/images/{imageId}/delete' => 
    array (
      0 => 'ListingController',
      1 => 'deleteImage',
    ),
    '/profile/edit' => 
    array (
      0 => 'ProfileController',
      1 => 'update',
    ),
    '/profile/update' => 
    array (
      0 => 'ProfileController',
      1 => 'update',
    ),
    '/profile/upload-document' => 
    array (
      0 => 'ProfileController',
      1 => 'uploadDocument',
    ),
    '/listings/{listingId}/apply' => 
    array (
      0 => 'ApplicationController',
      1 => 'store',
    ),
    '/applications/{id}/accept' => 
    array (
      0 => 'ApplicationController',
      1 => 'accept',
    ),
    '/applications/{id}/reject' => 
    array (
      0 => 'ApplicationController',
      1 => 'reject',
    ),
    '/applications/{id}/withdraw' => 
    array (
      0 => 'ApplicationController',
      1 => 'withdraw',
    ),
    '/notifications/trigger-approval' => 
    array (
      0 => 'NotificationController',
      1 => 'triggerApproval',
    ),
    '/chat/send' => 
    array (
      0 => 'ChatController',
      1 => 'sendMessage',
    ),
    '/admin/users/approve' => 
    array (
      0 => 'AdminController',
      1 => 'approveUser',
    ),
    '/admin/users/suspend' => 
    array (
      0 => 'AdminController',
      1 => 'suspendUser',
    ),
    '/admin/users/delete' => 
    array (
      0 => 'AdminController',
      1 => 'deleteUser',
    ),
    '/admin/documents/approve' => 
    array (
      0 => 'AdminController',
      1 => 'approveDocument',
    ),
    '/admin/listings/publish' => 
    array (
      0 => 'AdminController',
      1 => 'publishListing',
    ),
    '/admin/listings/pause' => 
    array (
      0 => 'AdminController',
      1 => 'pauseListing',
    ),
    '/admin/listings/delete' => 
    array (
      0 => 'AdminController',
      1 => 'deleteListing',
    ),
    '/moderator/listings/publish' => 
    array (
      0 => 'ModeratorController',
      1 => 'publishListing',
    ),
    '/moderator/listings/pause' => 
    array (
      0 => 'ModeratorController',
      1 => 'pauseListing',
    ),
    '/moderator/listings/delete' => 
    array (
      0 => 'ModeratorController',
      1 => 'deleteListing',
    ),
    '/moderator/documents/approve' => 
    array (
      0 => 'ModeratorController',
      1 => 'approveDocument',
    ),
  ),
);