<?php
// class pagination for Categories
class PaginationCategory{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=categories.php?page=1><< First</a></li> 
		                   <li><a href=categories.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=categories.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=categories.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=categories.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=categories.php?page=$next>&raquo;</a></li> 
		                     <li><a href=categories.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for Customer
class PaginationCustomer{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=customers.php?page=1><< First</a></li> 
		                   <li><a href=customers.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=customers.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=customers.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=customers.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=customers.php?page=$next>&raquo;</a></li> 
		                     <li><a href=customers.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for Supplier
class PaginationSupplier{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=suppliers.php?page=1><< First</a></li> 
		                   <li><a href=suppliers.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=suppliers.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=suppliers.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=suppliers.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=suppliers.php?page=$next>&raquo;</a></li> 
		                     <li><a href=suppliers.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for Staff
class PaginationStaff{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=staffs.php?page=1><< First</a></li> 
		                   <li><a href=staffs.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=staffs.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=staffs.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=staffs.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=staffs.php?page=$next>&raquo;</a></li> 
		                     <li><a href=staffs.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for Gudang / pabrik
class PaginationFactory{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=factories.php?page=1><< First</a></li> 
		                   <li><a href=factories.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=factories.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=factories.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=factories.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=factories.php?page=$next>&raquo;</a></li> 
		                     <li><a href=factories.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for product
class PaginationProduct{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=products.php?page=1><< First</a></li> 
		                   <li><a href=products.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=products.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=products.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=products.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=products.php?page=$next>&raquo;</a></li> 
		                     <li><a href=products.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for transfer
class PaginationTransfer{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=transfers.php?page=1><< First</a></li> 
		                   <li><a href=transfers.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=transfers.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=transfers.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=transfers.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=transfers.php?page=$next>&raquo;</a></li> 
		                     <li><a href=transfers.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for Kurs
class PaginationKurs{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=kurs.php?page=1><< First</a></li> 
		                   <li><a href=kurs.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=kurs.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=kurs.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=kurs.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=kurs.php?page=$next>&raquo;</a></li> 
		                     <li><a href=kurs.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for purchase order
class PaginationSpb{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=spb.php?page=1><< First</a></li> 
		                   <li><a href=spb.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=spb.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=spb.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=spb.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=spb.php?page=$next>&raquo;</a></li> 
		                     <li><a href=spb.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for bbm
class PaginationBbm{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=bbm.php?page=1><< First</a></li> 
		                   <li><a href=bbm.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=bbm.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=bbm.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=bbm.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=bbm.php?page=$next>&raquo;</a></li> 
		                     <li><a href=bbm.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for in
class PaginationIn{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=in.php?page=1><< First</a></li> 
		                   <li><a href=in.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=in.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=in.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=in.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=in.php?page=$next>&raquo;</a></li> 
		                     <li><a href=in.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for pay in
class PaginationPayIn{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=pay_in.php?page=1><< First</a></li> 
		                   <li><a href=pay_in.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=pay_in.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=pay_in.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=pay_in.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=pay_in.php?page=$next>&raquo;</a></li> 
		                     <li><a href=pay_in.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for sales order
class PaginationSo{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=so.php?page=1><< First</a></li> 
		                   <li><a href=so.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=so.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=so.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=so.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=so.php?page=$next>&raquo;</a></li> 
		                     <li><a href=so.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for delivery order
class PaginationDo{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=do.php?page=1><< First</a></li> 
		                   <li><a href=do.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=do.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=do.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=do.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=do.php?page=$next>&raquo;</a></li> 
		                     <li><a href=do.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for out
class PaginationOut{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=out.php?page=1><< First</a></li> 
		                   <li><a href=out.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=out.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=out.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=out.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=out.php?page=$next>&raquo;</a></li> 
		                     <li><a href=out.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for pay out
class PaginationPayOut{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=pay_out.php?page=1><< First</a></li> 
		                   <li><a href=pay_out.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=pay_out.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=pay_out.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=pay_out.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=pay_out.php?page=$next>&raquo;</a></li> 
		                     <li><a href=pay_out.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for retur supplier
class PaginationReturSupplier{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=retur_suppliers.php?page=1><< First</a></li> 
		                   <li><a href=retur_suppliers.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=retur_suppliers.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=retur_suppliers.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=retur_suppliers.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=retur_suppliers.php?page=$next>&raquo;</a></li> 
		                     <li><a href=retur_suppliers.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for retur staff
class PaginationReturStaff{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=retur_staffs.php?page=1><< First</a></li> 
		                   <li><a href=retur_staffs.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=retur_staffs.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=retur_staffs.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=retur_staffs.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=retur_staffs.php?page=$next>&raquo;</a></li> 
		                     <li><a href=retur_staffs.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for assembly
class PaginationAssembly{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=assembly.php?page=1><< First</a></li> 
		                   <li><a href=assembly.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=assembly.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=assembly.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=assembly.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=assembly.php?page=$next>&raquo;</a></li> 
		                     <li><a href=assembly.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for stock opname
class PaginationStockOpname{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=stock_opname.php?page=1><< First</a></li> 
		                   <li><a href=stock_opname.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=stock_opname.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=stock_opname.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=stock_opname.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=stock_opname.php?page=$next>&raquo;</a></li> 
		                     <li><a href=stock_opname.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for debts
class PaginationDebts{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=debts.php?page=1><< First</a></li> 
		                   <li><a href=debts.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=debts.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=debts.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=debts.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=debts.php?page=$next>&raquo;</a></li> 
		                     <li><a href=debts.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for receivables
class PaginationReceivable{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=receivables.php?page=1><< First</a></li> 
		                   <li><a href=receivables.php?page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=receivables.php?page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=receivables.php?page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=receivables.php?page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=receivables.php?page=$next>&raquo;</a></li> 
		                     <li><a href=receivables.php?page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for stock produk
class PaginationStockProduct{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=1><< First</a></li> 
		                   <li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_stock_products.php?module=stockproduct&act=search&categoryID=$_GET[categoryID]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

class PaginationStockSales{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=1><< First</a></li> 
		                   <li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_stock_sales.php?module=stocksales&act=search&categoryID=$_GET[categoryID]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for report assembly
class PaginationReportAssembly{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=1><< First</a></li> 
		                   <li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_assembly.php?module=assembly&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for report in
class PaginationReportIn{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=1><< First</a></li> 
		                   <li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_in.php?module=in&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for report out
class PaginationReportOut{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=1><< First</a></li> 
		                   <li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_out.php?module=out&act=search&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for report debt
class PaginationReportDebt{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=1><< First</a></li> 
		                   <li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_debts.php?module=debt&act=search&supplierID=$_GET[supplierID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>Last >></a></li> ";
		}
		else{
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		}
		
		return $link_page;
	}
}

// class pagination for report receives
class PaginationReportReceives{
		
	// function for checking the data position
	function searchPosition($limit){
		if(empty($_GET['page'])){
			$position = 0;
			$_GET['page'] = 1;
		}
		else{
			$position = ($_GET['page']-1) * $limit;
		}
		return $position;
	}
		
	// function for count the total page
	function amountPage($amountData, $limit){
		$amountPage = ceil($amountData/$limit);
		return $amountPage;
	}
		
	// function for page link 1,2.3 
	function navPage($activePage, $amountPage){
		$link_page = "";
		
		// link to first page and prev
		if($activePage > 1){
			$prev = $activePage-1;
			$link_page .= "<li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=1><< First</a></li> 
		                   <li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$prev>&laquo;</a></li> ";
		}
		else{ 
			$link_page .= "<li><a href='#'><< First</a></li> <li><a href='#'>&laquo;</a></li>";
		}
		
		// page link 1,2,3, ...
		$numeric = ($activePage > 3 ? " <li><a href='#'>...</a></li> " : " "); 
		for ($i=$activePage-2; $i<$activePage; $i++){
		if ($i < 1)
			continue;
			$numeric .= "<li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
		}
		$numeric .= " <li><a href='#' style='background-color: #eee;'>$activePage</a></li> ";
		
		for($i=$activePage+1; $i<($activePage+3); $i++){
			if($i > $amountPage)
				break;
				$numeric .= "<li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$i>$i</a></li>";
	    }
	    $numeric .= ($activePage+2<$amountPage ? " <li><a href='#'>...</a></li> <li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>$amountPage</a></li> " : " ");
	    
	    $link_page .= "$numeric";
	    
	    // Link to the next page and the last page
	    if($activePage < $amountPage){
			$next = $activePage+1;
			$link_page .= " <li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$next>&raquo;</a></li> 
		                     <li><a href=report_receives.php?module=receive&act=search&customerID=$_GET[customerID]&startDate=$_GET[startDate]&endDate=$_GET[endDate]&page=$amountPage>Last >></a></li> ";
		} else {
			$link_page .= "<li><a href='#'>&raquo;</a></li><li><a href='#'>Last >></a></li>";
		} return $link_page; }
} function cetak($data){ print("<pre>".print_r($data,true)."</pre>"); } 
?>