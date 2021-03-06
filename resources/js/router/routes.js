function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },
  { path: '/add-food', name: 'addFood', component: page('food/add.vue') },
  { path: '/edit-food/:id', name: 'editFood', component: page('food/edit.vue') },
  { path: '/add-history', name: 'addHistory', component: page('food/history.vue') },
  { path: '/spend-manage', name: 'spendIndex', component: page('spend.vue') },
  { path: '/spend-add', name: 'spendAdd', component: page('spend/add.vue') },
  { path: '/add-weight', name: 'addWeight', component: page('food/weight.vue') },
  { path: '/list-food', name: 'listFood', component: page('food/list.vue') },
  { path: '/list-food-request', name: 'listFoodRequest', component: page('food/request.vue') },
  { path: '/list-post', name: 'listPost', component: page('post/list.vue') },
  { path: '/edit-post/:id', name: 'editPost', component: page('post/edit.vue') },
  { path: '/add-post', name: 'addPost', component: page('post/add.vue') },
  { path: '/list-points', name: 'listPoints', component: page('point/list.vue') },
  { path: '/manage-points', name: 'managePoints', component: page('point/manage-list.vue') },
  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/tdee', name: 'tdee', component: page('tdee.vue') },
  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ] },

  { path: '*', component: page('errors/404.vue') }
]
