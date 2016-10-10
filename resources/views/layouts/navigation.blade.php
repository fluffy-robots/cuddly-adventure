<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ auth()->user()->name }}</strong>
                     </span> <span class="text-muted text-xs block">Indstillinger <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        {{--<li><a href="profile.html">Profile</a></li>--}}
                        {{--<li><a href="contacts.html">Contacts</a></li>--}}
                        {{--<li><a href="mailbox.html">Mailbox</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="grid_options.html"><i class="fa fa-tachometer nav--ikon-farve"></i> <span class="nav-label">Kontrolpanel</span></a>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-desktop nav--ikon-farve"></i> <span class="nav-label">Products </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="/product-catalog">Product Catalog</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/product-types">Product Types</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-picture-o nav--ikon-farve"></i> <span class="nav-label">Media</span></a>
                <ul class="nav nav-second-level">
                    <li><a href="/media">Filer / Billeder</a></li>
                    <li><a href="/trashcan">Gendan</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="/ui-elements"><i class="fa fa-tachometer nav--ikon-farve"></i> <span class="nav-label">UI Elementer</span></a></ul>
            </li>
        </ul>
    </div>
</nav>