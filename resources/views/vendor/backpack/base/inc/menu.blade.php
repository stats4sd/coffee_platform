<!-- =================================================== -->
<!-- ========== Top menu items (ordered left) ========== -->
<!-- =================================================== -->
<ul class="nav navbar-nav d-md-down-none">

</ul>
<!-- ========== End of top menu left items ========== -->


<!-- ========================================================= -->
<!-- ========= Top menu right items (ordered right) ========== -->
<!-- ========================================================= -->
<ul class="nav navbar-nav ml-auto @if(config('backpack.base.html_direction') == 'rtl') mr-0 @endif">
    <!-- Topbar. Contains the right part -->
    <li class="nav-item dropdown pr-4">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            {{ t('Change Language') }}
        </a>
        <div class="dropdown-menu mr-4 pb-1 pt-1">
            <a class="dropdown-item" href="{{ URL::current() . '?locale=en' }}">{{ t('English') }}</a>
            <a class="dropdown-item" href="{{ URL::current() . '?locale=es' }}">{{ t('Spanish') }}</a>
        </div>
    </li>
    <li class="nav-item pr-4">
        <a class="nav-link" href="{{ route('backpack.account.info') }}">
            <i class="la la-user"></i> {{ trans('backpack::base.my_account') }}
        </a>
    </li>
    <li class="nav-item pr-4">
        <a class="nav-link" href="{{ backpack_url('logout') }}">
            <i class="la la-lock"></i> {{ trans('backpack::base.logout') }}
        </a>
    </li>
</ul>
<!-- ========== End of top menu right items ========== -->
