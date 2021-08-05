const autorSelect = document.querySelector('#autor_select');

const barq = new Barq (autorSelect,{
    placeholderText: 'escoger un autor',
    noResultsMessage: 'no hay autores que coincidad :(',
    onchange: function() {
      //  alert('You selected the ' + this.text + ' model.');
    }
});

barq.init();

