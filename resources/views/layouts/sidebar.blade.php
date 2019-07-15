<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<div class="brand">
		<a href="{{ url('/') }}">
			<img src="{{ asset('images/brandimage.jpg') }}" class="" alt="{{ config('app.name', 'JU') }}">
		</a>
	</div>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class
				with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="{{ url('/home') }}" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>

				<li class="{{ \Request::is('bill/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Bill
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('bill') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Bills</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('bill.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Bill</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('employee/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-gear"></i>
						<p>
							Employee
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('employee') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Employees</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('employee.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Employee</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('expense/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-th"></i>
						<p>
							Expense
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('expense') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Expenses</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('expense.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Expense</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ url('expense-item') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Expense Items</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('expense-item.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add New Expense Item</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('customer/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-th"></i>
						<p>
							Customer
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('customer') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Customers</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('customer.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Customer</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="{{ \Request::is('service/*') ? 'nav-item has-treeview menu-open' : 'nav-item has-treeview'  }}">
					<a href="#" class="nav-link item">
						<i class="nav-icon fa fa-gear"></i>
						<p>
							Service
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ url('service') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Services</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('service.create') }}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add Service</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="{{ url('sms') }}" class="nav-link">
						<i class="fa fa-envelope"></i>
						<p>SMS</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
