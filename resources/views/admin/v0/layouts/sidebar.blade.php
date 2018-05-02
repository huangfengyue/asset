<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                  <img alt="image" class="img-circle" src="/static/agency/v0/img/profile_small.jpg">
                   </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"> haah <strong class="font-bold"></strong>
                   </span> <span class="text-muted text-xs block">hasha <b class="caret"></b></span> </span> </a>
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
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">会员管理模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^admin\/user/',$currentRoute)) class="active" @endif><a href="/admin/user">公益使者申请</a></li>
                    <li @if(preg_match('/^admin\/user\/dummyLists/',$currentRoute)) class="active" @endif><a href="/admin/user/dummyLists">虚拟公益使者列表</a></li>
                    <li @if(preg_match('/^admin\/user\/enlists/',$currentRoute)) class="active" @endif><a href="/admin/user/enlists">报名列表</a></li>
                    <li @if(preg_match('/^agency\/repay/',$currentRoute)) class="active" @endif><a href="/agency/repay">还款跟踪</a></li>
                </ul>
            </li>
            <li @if(preg_match('/^chushen\/(asset|repay|asset\/\S+)$/',$currentRoute)) class="active" @endif>
                <a href="javascript:;"><i class="fa fa-cog"></i> <span class="nav-label">审件模块</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if(preg_match('/^chushen\/asset$/',$currentRoute)) class="active" @endif><a href="/chushen/asset">审件列表</a></li>
                    <li @if(preg_match('/^chushen\/asset\/check2$/',$currentRoute)) class="active" @endif><a href="/chushen/asset/check2">面签列表</a></li>
                    <li @if(preg_match('/^chushen\/asset\/repay/',$currentRoute)) class="active" @endif><a href="/chushen/asset/repay">还款列表</a></li>
                    <li @if(preg_match('/^chushen\/repay$/',$currentRoute)) class="active" @endif><a href="/chushen/repay">还款跟踪</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>