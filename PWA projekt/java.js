$(function() {
  var $FormaPrijava = $("#izrada");
  $FormaPrijava.validate({
    rules: {
      Naslov:{
        required: true,
        minlength: 5,
        maxlength:30,
      },
      Sazetak:{
        required: true,
        minlength:10,
        maxlength:100,
      },
      Vijest:{
        required: true,
      },
      Kategorija:{
        required: true,
      },
      Slika:{
        required: true,
      },
    },
      messages: {
        Naslov:{
        required: 'Naskov mora imaati od 5 do 30 znakova',
        minlength: 'Premalo  znakova',
        maxlength: 'Previse znakova',
      },
      Sazetak:{
        required: 'Kratak sadrzaj vjesti je obavezan',
        minlength: 'Premaalo znakova',
        maxlength: 'Previse znakova',
      },
      Vijest:{
        required: 'Tekst je obavezan',
      },
      Kategorija:{
        required: 'Kategorija je obavezna',
      },
      Slika:{
        required: 'Slika je obavezna',
        },
    },
    submitHandler:function(form) {
      form.submit();
    },
  });
});
