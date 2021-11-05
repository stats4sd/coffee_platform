<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">User Management</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'> Users</a></li>
    </ul>
</li>

<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">Indicators</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('indicator') }}'> Indicators</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('indicator_value') }}'> Indicator Values</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('geo_boundary') }}'> Geo Boundaries</a></li>
    </ul>
</li>

<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">Lookup Fields</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('characteristic') }}'> Characteristics</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sub_characteristic') }}'> Sub Characteristics</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unit') }}'> Units</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unittype') }}'> Unit Types</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gender') }}'> Genders</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('smallholder_definition') }}'> Smallholder Definitions</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('purpose_of_collection') }}'> Purpose Of Collections</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('approach_collection') }}'> Approach Collections</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'> Countries</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'> Regions</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'> Departments</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('municipality') }}'> Municipalities</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('source') }}'> Sources</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('type') }}'> Types</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('partner') }}'> Partners</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('year') }}'> Years</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('scope') }}'> Scopes</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('group') }}'> Groups</a></li>
    </ul>
</li>

