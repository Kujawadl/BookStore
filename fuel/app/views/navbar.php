<?php
if (Auth::check())
{
  global $CartQty;
  $Query = Model_Order::query()
            ->where('customer', '=', Auth::get_user_id()[1])
            ->where('date', '=', NULL);
  if ($Query->count() == 1)
  {
    $CartQty = $Query->get_one()->Quantity();
  }
}
?>

<div id="header">
  <div id="nameplate">
    <h1>Book Store</h1>
  </div>

  <nav class='navbar <?php echo Auth::member(100) ? 'navbar-inverse' : 'navbar-default' ?>' role='navigation'>
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-book"></span> Home</a>
      </div>
      <div id='navbar' class='collapse navbar-collapse'>
        <ul class="nav navbar-nav">
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
          <li>
            <a href="/cart/view">
              <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp;
              Cart&nbsp;
              <?php echo((isset($CartQty)) ? '(' . $CartQty . ')' : ''); ?>
            </a>
          </li>
          <?php if (Auth::check() && !Auth::member(0)): ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user"></span>
                <?php
                  $CustomerId = Auth::get_profile_fields('CustomerId');
                  $Customer = Model_Customer::find($CustomerId);
                  echo($Customer->FName . ' ' . $Customer->LName);
                ?>
                <spann class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="/orders/list">
                    <span class="glyphicon glyphicon-time"></span> Order History
                  </a>
                </li>
                <li>
                  <a href="/account/settings">
                    <span class="glyphicon glyphicon-pencil"></span> Settings
                  </a>
                </li>
                <li>
                  <a href="/account/signout">
                    <span class="glyphicon glyphicon-log-out"></span> Logout
                  </a>
                </li>
                <?php if (Auth::member(100)): ?>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="#">
                      <span class="glyphicon glyphicon-cog"></span> Administration
                    </a>
                  </li>
                  <li><a href="/admin/books">&emsp;&emsp;Books</a></li>
                  <li><a href="/admin/authors">&emsp;&emsp;Authors</a></li>
                  <li><a href="/admin/suppliers">&emsp;&emsp;Suppliers</a></li>
                  <li><a href="/admin/customers">&emsp;&emsp;Customers</a></li>
                  <li><a href="/admin/orders">&emsp;&emsp;Orders</a></li>
                  <li>
                    <a href="/phpMyAdmin/index.php" target="_blank">
                      <span class="glyphicon glyphicon-wrench"></span> phpMyAdmin
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
