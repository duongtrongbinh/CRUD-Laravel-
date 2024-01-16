// function actionDeleteCategory(e){
//     e.preventDefault();
//     let urlRequest = $(this).data('url');
//     let that = $(this);
//     Swal.fire({
//         title: "Are you sure?",
//         text: "You won't be able to revert this!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes, delete it!"
//       }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 type: 'GET',
//                 url: urlRequest,
//                 success: function (data) {
//                     if(data.code == 200){
//                     that.parent().parent().remove();
//                     Swal.fire({
//                     title: "Deleted!",
//                     text: "Your file has been deleted.",
//                     icon: "success"
//           });
//                     }
//                 },
//                 error: function (data) {
//                     if(data.code == 500){
//                         Swal.fire({
//                         title: "Cancelled",
//                         text: "Your imaginary file is safe :)",
//                         icon: "error"
//           });
//                     }
//                 }
//             });

//         }
//       });

// }

// $(function () {

// })

// $("form").submit(function(event) {
//     event.preventDefault();
//     var form = $(this);
//     var url = form.attr('action');
//     $.ajax({
//       type: "POST",
//       url: url,
//       data: form.serialize(),
//       success: function(data) {
//         alert(data);
//       }
//     });
//   });