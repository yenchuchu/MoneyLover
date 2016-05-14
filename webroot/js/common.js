function deleteAll (url,ids) {
  if (!confirm('Are you sure you want to delete!')) {
    return false;
  }

  $.ajax({
      type: "POST",
      url: url,
      dataType: 'json',
      data: {ids: ids},
      success: function (res) {
          alert(res.message);
          if (res.status === 0) {
              location.reload();
          } 
      }
  });
}

function hashPassword(url, changeOldPass, c) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'post',
        data: {title: changeOldPass},
        success: function(result){
            c(result.message); 
        }
    });
}

//function searchCategory(url, name, type) {
//    $.ajax({
//       url: url,
//       dataType: 'json',
//       type: 'post',
//       data: {
//           searchType: type,
//           searchName: name
//       },
//       success: function(result) {
//           console.log(result);
//           $.each(result, function(index, categoryObj){
//               $('tr.tr-category ').remove();
//               console.log(categoryObj.name);
//               
//               $('.table-striped').append(' <tr class="tr-category">'+categoryObj.name +' \n\
//                    <td> \n\
//                        <input type="checkbox" name="category_id[]" \n\
//                            class="category-checkbox"  value="'+categoryObj.id+'" \n\
//                            id="'+categoryObj.id+'">\n\
//                    </td> \n\
//                    <td class="tr-category-id">'+categoryObj.id+'</td> \n\
//                    <td class="tr-category-name">'+categoryObj.name+'</td> \n\
//                    <td class="tr-category-type">'+categoryObj.type+'</td> \n\
//                    <td>'+categoryObj.created+'</td> \n\
//                    <td>'+categoryObj.modified+'</td> \n\
//                    <td class="actions"> \n\
//                        <a style="float:none;color:#27c24c" class="update-link" \n\
//                            id="update-link" data-toggle="modal" data-target="#editModal" title="Edit"> \n\
//                            <i class="fa fa-pencil-square-o"></i> \n\
//                        </a> \n\
//                        <a href="#" id="delete-link" name="'+categoryObj.id+'" \n\
//                            data-toggle="modal" data-target="#deleteModal" \n\
//                            class="delete-transaction glyphicon glyphicon-trash" title="Delete" \n\
//                            onclick="deleteSigle(this.name)">\n\
//                        </a> \n\
//                        </td>  \n\
//                </tr> ');
//           });
//       }
//    });
//}
//
//function searchTransaction(url, cate, wallet, money, day, month, year) {
//    $.ajax({
//       url: url,
//       dataType: 'html',
//       type: 'post',
//       data: {
//            searchCate: cate,
//            searchWallet: wallet,
//            searchMoney: money,
//            searchDay: day,
//            searchMonth: month,
//            searchYear: year
//       },
//       success: function(result) {
//           alert('ok');
//        }
//             
//    });
//}
//
//function searchTransfer(url, name, type) {
//    $.ajax({
//       url: url,
//       dataType: 'html',
//       type: 'post',
//       data: {
//           searchType: type,
//           searchName: name
//       },
//       success: function(result) {
////           var test = removeDuplicates(result, "id");
////            console.log(test);
////        if(result.status != 1 ) {
//            $('.tr-category').empty();
//            $('.page').empty();
////            $.each(function(index) {
////                
////            });
////        }
//            alert(result[0]['message']);
//            $.each (result, function (bb) {
//                console.log (bb);
//               console.log (result[bb]);
//               console.log (result[bb].name);
//            });
//       }
//    });
//}