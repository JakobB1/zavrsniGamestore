
/** Polaznici */
    $( '#uvjet' ).autocomplete({
        source: function(req,res){
           $.ajax({
               url: '/polaznik/trazipolaznik/' + req.term + '/' + grupa,
               success:function(odgovor){
                   res(odgovor);
                //console.log(odgovor);
            }
           }); 
        },
        minLength: 2,
        select:function(dogadaj,ui){
            spremi(ui.item);
        }
    }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
        return $( '<li>' )
          .append( '<div>' + item.sifra + ' ' + item.ime + ' ' + item.prezime + '</div>')
          .appendTo( ul );
      };

      function spremi(polaznik){
          console.log(grupa);
          console.log(polaznik.sifra);
          $.ajax({
            url: '/grupa/dodajpolaznik/' + grupa + '/' + polaznik.sifra,
            success:function(odgovor){
                if(odgovor==='OK'){
                    $('#polaznici').append('<tr>' + 
                        '<td>' + polaznik.ime +' ' + polaznik.prezime +'</td>' + 
                        '<td>' + 
                            '<a onclick="return confirm(\'Sigurno obrisati?\');"  ' + 
                            ' id="b_' + polaznik.sifra + '" ' +
                            ' class="brisiPolaznika" ' + 
                            ' href="#"> ' + 
                                '<i style="color: red" title="Obriši" ' + 
                                    'class="fas fa-2x fa-trash"></i>' + 
                            '</a>  ' + 
                        '</td>' + 
                    '</tr>');
                    definirajBrisanjePolaznika();
                }else{
                    alert('Dogodila se pogreška, pokušajte ponovo');
                }
               
             
         }
        }); 
      }


      function definirajBrisanjePolaznika(){
        $('.brisiPolaznika').click(function(){
            let element = $(this);
            let sifra = element.attr('id').split('_')[1];
            $.ajax({
              url: '/grupa/brisipolaznik/' + grupa + '/' + sifra,
              success:function(odgovor){
                  if(odgovor==='OK'){
                     element.parent().parent().remove();
                  }else{
                      alert('Dogodila se pogreška, pokušajte ponovo');
                  }
                 
               
           }
          }); 
  
          return false;
        });
      }

      definirajBrisanjePolaznika();
      

      /* Završili polaznici */





      /* Predavač */

      $( '#uvjetPredavac' ).autocomplete({
        source: function(req,res){
           $.ajax({
               url: '/predavac/trazipredavac/' + req.term ,
               success:function(odgovor){
                   res(odgovor);
                //console.log(odgovor);
            }
           }); 
        },
        select:function(dogadaj,ui){
           console.log(ui.item);
           $('#predavac').val(ui.item.sifra);
           $('#odabraniPredavac').html(ui.item.ime + ' ' + ui.item.prezime);
        }
    }).autocomplete( 'instance' )._renderItem = function( ul, item ) {
        return $( '<li>' )
          .append( '<div>' + item.ime + ' ' + item.prezime + '</div>')
          .appendTo( ul );
      };


      $('#uvjetPredavac').on('keypress', function (e) {
        if(e.which !== 13){
            return;
        }
          let predavac = $('#uvjetPredavac').val().split(' ');
          if(predavac.length==0){
              return false;
          }
          let ime='';
          let prezime='';
          if(predavac.length>1){
              ime = predavac[0];
              prezime = predavac[1];
          }else{
              prezime=predavac[0];
          }

          $.ajax({
            url: '/predavac/dodajPredavac/' +ime + '/' + prezime ,
            success:function(odgovor){
                $('#predavac').val(odgovor);
                $('#odabraniPredavac').html(ime + ' ' + prezime);
         }
        }); 

        return false;
  });

  /* Završio predavač */