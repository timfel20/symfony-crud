const suppliers = document.getElementById('suppliers');

if (suppliers) {
  suppliers.addEventListener('click', e => {   
    const id = e.target.getAttribute('data-id');
    fetch(`/article/delete/${id}`, {
        method: 'DELETE'
    }).then(res => window.location.reload());      
  });
}