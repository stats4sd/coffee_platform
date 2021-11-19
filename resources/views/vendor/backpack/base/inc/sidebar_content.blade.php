<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">{{t('User Management')}}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'> {{t('Users')}}</a></li>
    </ul>
</li>

<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">{{t('Indicators')}}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('indicator') }}'> {{t('Indicators')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('indicator_value') }}'> {{t('Indicator Values')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('geo_boundary') }}'> {{t('Geo Boundaries')}}</a></li>
    </ul>
</li>

<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href="#">{{t('Lookup Fields')}}</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('characteristic') }}'> {{t('Characteristics')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('sub_characteristic') }}'> {{t('Sub Characteristics')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unit') }}'> {{t('Units')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unittype') }}'> {{t('Unit Types')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('gender') }}'> {{t('Genders')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('smallholder_definition') }}'> {{t('Smallholder
            Definitions')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('purpose_of_collection') }}'> {{t('Purpose Of
            Collections')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('approach_collection') }}'> {{t('Approach
            Collections')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('country') }}'> {{t('Countries')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('region') }}'> {{t('Regions')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'> {{t('Departments')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('municipality') }}'> {{t('Municipalities')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('source') }}'> {{t('Sources')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('type') }}'> {{t('Types')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('partner') }}'> {{t('Partners')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('year') }}'> {{t('Years')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('scope') }}'> {{t('Scopes')}}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('group') }}'> {{t('Groups')}}</a></li>
    </ul>
</li>

