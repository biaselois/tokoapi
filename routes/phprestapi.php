<?php
require_once "koneksi.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_produk()
   {
      global $connect;      
      $query = $connect->query("SELECT * FROM produk");            
      while($row=mysqli_fetch_object($query))
      {
         $data[] =$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }   
   
   function get_produk_id()
   {
      global $connect;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }            
      $query ="SELECT * FROM produk WHERE id= $id";      
      $result = $connect->query($query);
      while($row = mysqli_fetch_object($result))
      {
         $data[] = $row;
      }            
      if($data)
      {
      $response = array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );               
      }else {
         $response=array(
                     'status' => 0,
                     'message' =>'No Data Found'
                  );
      }
      
      header('Content-Type: application/json');
      echo json_encode($response);
       
   }
   function insert_produk()
      {
         global $connect;   
         $check = array('id' => '', 'kode_produk' => '', 'nama_produk' => '', 'harga' => '');
         $check_match = count(array_intersect_key($_POST, $check));
         if($check_match == count($check)){
         
               $result = mysqli_query($connect, "INSERT INTO produk SET
               id = '$_POST[id]',
               kode_produk = '$_POST[kode_produk]',
               nama_produk = '$_POST[nama_produk]',
               harga = '$_POST[harga]'");
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Insert Success'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Insert Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
   function update_produk()
      {
         global $connect;
         if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }   
         $check = array('kode_produk' => '', 'nama_produk' => '', 'harga' => '');
         $check_match = count(array_intersect_key($_POST, $check));         
         if($check_match == count($check)){
         
              $result = mysqli_query($connect, "UPDATE produk SET               
               kode_produk = '$_POST[kode_produk]',
               nama_produk = '$_POST[nama_produk]',
               harga = '$_POST[harga]' WHERE id = $id");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Update Success'                  
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Update Failed'                  
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Wrong Parameter',
                     'data'=> $id
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
   function delete_produk()
   {
      global $connect;
      $id = $_GET['id'];
      $query = "DELETE FROM produk WHERE id=".$id;
      if(mysqli_query($connect, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Delete Success'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Delete Fail.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 ?>