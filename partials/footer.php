 <!-- Main Footer -->
 <footer class="main-footer">
   <!-- To the right -->
   <!-- Default to the left -->
   <strong>Copyright &copy; <?php date('Y') ?> <a href="javascript:void(0);">Muhammad Humaidi</a>.</strong> All rights reserved.
 </footer>
 <script>
   $(document).on({
     mouseenter: function() {
       trIndex = $(this).index() + 1;
       $("table.dataTable").each(function(index) {
         $(this).find("tr:eq(" + trIndex + ")").each(function(index) {
           $(this).find("td").addClass("hover");
         });
       });
     },
     mouseleave: function() {
       trIndex = $(this).index() + 1;
       $("table.dataTable").each(function(index) {
         $(this).find("tr:eq(" + trIndex + ")").each(function(index) {
           $(this).find("td").removeClass("hover");
         });
       });
     }
   }, ".dataTables_wrapper tbody>tr");
 </script>