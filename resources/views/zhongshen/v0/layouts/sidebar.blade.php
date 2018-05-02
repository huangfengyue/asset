<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                  <img alt="image" class="img-circle" src="/static/agency/v0/img/profile_small.jpg">
                   </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"> {{$loginUserInfo->nickname or $loginUserInfo->username}} <strong class="font-bold"></strong>
                   </span> <span class="text-muted text-xs block">{{config("roles.".$loginUserInfo->role_id.".role_name")}} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">个人主页</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">退出</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ID
                </div>
            </li>
            <li @if(preg_match('/^agency\/(repay|asset|asset\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">进件模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^agency\/asset$/',$currentRoute)) class="active" @endif><a href="/agency/asset">进件列表</a></li>
                    <li @if(preg_match('/^agency\/asset\/check2/',$currentRoute)) class="active" @endif><a href="/agency/asset/check2">面签列表</a></li>
                    <li @if(preg_match('/^agency\/asset\/repay/',$currentRoute)) class="active" @endif><a href="/agency/asset/repay">还款列表</a></li>
                    <li @if(preg_match('/^agency\/repay/',$currentRoute)) class="active" @endif><a href="/agency/repay">还款跟踪</a></li>
                </ul>
            </li>
            <li @if(preg_match('/^zhongshen\/(asset|repay|asset\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">审件模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^zhongshen\/asset$/',$currentRoute)) class="active" @endif><a href="/zhongshen/asset">审件列表</a></li>
                    <li @if(preg_match('/^zhongshen\/asset\/check2/',$currentRoute)) class="active" @endif><a href="/zhongshen/asset/check2">面签列表</a></li>
                    <li @if(preg_match('/^zhongshen\/asset\/repay/',$currentRoute)) class="active" @endif><a href="/zhongshen/asset/repay">还款列表</a></li>
                    <li @if(preg_match('/^zhongshen\/repay$/',$currentRoute)) class="active" @endif><a href="/zhongshen/repay">还款跟踪</a></li>
                </ul>
            </li>
            <li @if(preg_match('/^financer\/(repay|asset|asset\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">财务模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^financer\/asset$/',$currentRoute)) class="active" @endif><a href="/financer/asset">放款列表</a></li>
                    <li @if(preg_match('/^financer\/repay$/',$currentRoute)) class="active" @endif><a href="/financer/repay">还款管理</a></li>
                </ul>
            </li>
            <li @if(preg_match('/^operator\/(repay|asset|asset\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">催收模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
              </ul>
            </li>
           <li @if(preg_match('/^admin\/(user|user\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">用户管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^admin\/user$/',$currentRoute)) class="active" @endif><a href="/admin/user">用户列表</a></li>
                    <li @if(preg_match('/^admin\/user\/create$/',$currentRoute)) class="active" @endif><a href="/admin/user/create">添加用户</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>