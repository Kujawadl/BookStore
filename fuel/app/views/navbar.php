<div id="header">
  <div id="nameplate">
    <h1>Book Store</h1>
  </div>

  <nav class='navbar <?php echo Auth::member(100) ? 'navbar-inverse' : 'navbar-default' ?>' role='navigation'>
    <div class="container-fluid">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div id='navbar' class='collapse navbar-collapse'>
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Browse<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/browse/books">Books</a></li>
              <li><a href="/browse/authors">Authors</a></li>
              <li><a href="/browse/categories">Categories</a></li>
            </ul>
          </li>
          <form id="frmSearch" class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" id="txtSearch" class="form-control" placeholder="Search">
            </div>
            <button type="submit" id="btnSearch" class="btn btn-default">Submit</button>
          </form>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <?php if (Auth::check() && !Auth::member(0)): ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <?php echo Auth::get_profile_fields('firstname', '').' '.Auth::get_profile_fields('lastname', '') ?>
                <spann class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="/user/signout">
                    <span class="glyphicon glyphicon-log-out"></span> Logout
                  </a>
                </li>
                <?php if (Auth::member(100)): ?>
                  <li>
                    <a href="/phpMyAdmin/index.php" target="_blank">
                      <span class="glyphicon glyphicon-cog"></span> phpMyAdmin
                    </a>
                  </li>
                <?php endif ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-log-in"></span> Login
              </a>
              <ul id="login-dp" class="dropdown-menu">
                <li>
                  <div class="row">
                    <div class="col-md-12">
                      <form action="/account/signin" method="post" class="form" role="form">
                        <div class="form-group">
                          <label class="sr-only" for="username">Username</label>
                          <input type="text" class="form-control" placeholder="Username" name="username" required>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="password">Password</label>
                          <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-default">Login</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li>
              <a href="/account/signup">
                <span class="glyphicon glyphicon-user"></span> Register
              </a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
</div>
