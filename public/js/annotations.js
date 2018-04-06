// text highlight function
    $(document).ready(function(){
      var data_id;
      var annotation_data;

      $('.content__article a').on('click', function(){
        data_id = $(this).attr('data-id');
        $.ajax({
          url : '/annotations/' + data_id,
          dataType: 'json',
          success : function(data){
            annotation_data = data;
            //document.write(data);

            // no content yet
            if(annotation_data.content == null){
              $('#anno-edit').fadeIn();
            }
            // show content
            else{
              $('#anno-show').find("div[name='content__annotation']").html(annotation_data.content);
              $('#anno-show').find("h4[name='user_name']").html(annotation_data.name);
              $('#anno-show').find("h5[name='user_email']").html(annotation_data.email);
              $('#anno-show').fadeIn();

              $('.edit').on('click', function(){
                $('#anno-show').fadeOut();
                $('#anno-edit').find("textarea[name='anno_content']").html(annotation_data.content);
                $('#anno-edit').fadeIn();
              });

              $('.destroy').on('click', function(){
                $('.content__article').find("a[data-id='"+ annotation_data.id +"']").each(function(){
                  $(this).replaceWith($(this).text());
                });

                var article_content = $('div.content__article p').html();
                $.ajax({
                type: 'PUT',
                url: '/articles/' + annotation_data.article_id,
                data: {
                  'content' : article_content
                },
                error: function(request, status, error){
                  //alert('aa');
                  //alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                  //document.write(request.responseText);
                  },
                success: function(){
                  toastr.success('해석이 삭제되었습니다.', 'Success Alert', {timeOut: 5000});
                }
                  }).done(function(){
                    //$('#anno-create').fadeOut();
                    $.ajax({
                      type: 'DELETE',
                      url: '/annotations/' + data_id,
                    }).then(function () {
                         window.location.href = '/articles/' + annotation_data.article_id;
                    }); 
                  });
              });
            }
          }
        });

        //$('#anno-edit').fadeIn();
        //alert(data_id);
      });

      $('.update').on('click',function(){
        var content = $('#anno-edit').find("textarea[name='anno_content']").val();

        $.ajax({
          type: 'PUT',
          url: '/annotations/' + annotation_data.id,
          data:{
            'content' : content
          },
          success: function(){
            //alert('updated! '+content);
            toastr.success('성공적으로 갱신되었습니다.', 'Success Alert', {timeOut: 5000});
          }
        }).done(function(){
          //$('#anno-edit').fadeOut();
          window.location.href = '/articles/' + annotation_data.article_id;
        })
      });

      $('.content__article').on('click', function(){ 
          var strlen = window.getSelection().toString().length;
          /*  
          if (window.getSelection) {
          text = window.getSelection().toString();
          } else if (document.selection && document.selection.type != "Control") {
              text = document.selection.createRange().text;
          }
          */
          //alert(text);
          if( strlen > 0 ){
            $('#anno-create').fadeIn();
          }
          

          var replacementText = textSelection();
          var articleId = $('article').data('id');
          var userId = window.Laravel.currentUser.id;
          var article_content;

          $('.create').on('click', function(e){
          	e.preventDefault();

            $.ajax({
              type: 'POST',
              url: '/annotations',
              data: {
                'article_id' : articleId,
                'user_id' : userId
              },
              success: function (data){
                annotation_data = data;
                //alert(annoId);
                replaceSelectedText(replacementText, annotation_data.id);
              },
              error: function(request, status, error){
              	alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
              	//document.write(request.responseText);
              	//window.location.href = '';
              }
            }).then(function (){
              //window.location.href = '/articles/' + articleId;

              article_content=$('div.content__article p').html();
              //alert(article_content);
              $.ajax({
	      			type: 'PUT',
	      			url: '/articles/' + articleId,
	      			data: {
	      				'content' : article_content
	      			},
	      			error: function(request, status, error){
	      				alert('aa');
	      				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
	      				document.write(request.responseText);
	      			  },
              success: function(){
                toastr.success('이제 원하는 내용을 입력해보세요!', 'Success Alert', {timeOut: 5000});
              }
              	}).done(function(){
                  //$('#anno-create').fadeOut();
                  window.location.href = '/articles/' + articleId;
              	});
            })
          });

          /*
          $('a.btn-layerClose').click(function(){
             $('.create-layer').fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
            return false;
           });
          */

          $('.dimBg').click(function(){
              $('.dim-layer').fadeOut();
              return false;
          });
      });
    });
    // return selectedText(include html not just string)
      function textSelection() {
        var html = "";
        if (typeof window.getSelection != "undefined") {
          var sel = window.getSelection();
            if (sel.rangeCount) {
                var container = document.createElement("div");
                for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                    container.appendChild(sel.getRangeAt(i).cloneContents());
                }
                //html = '<a href="'+ id + '">' + container.innerHTML + '</a>';
                html = container.innerHTML;
            }
        } 
        else if (typeof document.selection != "undefined") {
            if (document.selection.type == "Text") {
              html = document.selection.createRange().htmlText;
              //html = '<a href="'+ id + '">' + container.innerHTML + '</a>';
              html = container.innerHTML;
            }
        }
        return html;
    }
    // replace text to anchored html function
    function replaceSelectedText(replacementText, id) {
        var sel, range;
        var container = document.createElement("a");
        var att = document.createAttribute("href");
        att.value = '#' + id;
        container.setAttributeNode(att);

        att = document.createAttribute("data-id");
        att.value = id;
        container.setAttributeNode(att);

        container.innerHTML = replacementText;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                //range.insertNode(document.createTextNode(replacementText));
                range.insertNode(container);
            }
        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            range.text = '<a href="/annotations/'+ id + '">' + replacementText + '</a>';
      }
    }