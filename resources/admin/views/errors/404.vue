<template>
	<div>
		<section class="content-header">
	      <h1>
	        404 错误
	      </h1>
	    </section>
		<section class="content">
	      <div class="error-page">
	        <h2 class="headline text-yellow"> 404</h2>
	
	        <div class="error-content">
	          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
	
	          <p>
	            We could not find the page you were looking for.
	            Meanwhile, you may <a href="javascript:void(0)">return to dashboard</a> or try using the search form.
	          </p>
	
	          <form class="search-form">
	            <div class="input-group">
	              <input type="text" name="search" class="form-control" placeholder="Search">
	
	              <div class="input-group-btn">
	                <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
	                </button>
	              </div>
	            </div>
	            <!-- /.input-group -->
	          </form>
	        </div>
	        <!-- /.error-content -->
	      </div>
	      <!-- /.error-page -->
	    </section>
	</div>
</template>
<script>
export default{
	name: 'error-page-404'
}
</script>