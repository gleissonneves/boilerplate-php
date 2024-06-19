
module.exports = function () {
  const fakeRequest = (path, key = 'return') => require(`./data/${path}.json`)[key];

  return {
    // 
    login: fakeRequest('login'),
    
    // 
    marca: fakeRequest('marca'),

    // 
    modelo: fakeRequest('modelo'),

    // 
    'tipo-de-servico': fakeRequest('tipo-de-servico'),

    // 
    'tipo-de-acesso': fakeRequest('tipo-de-acesso'),
    
    // 
    'ordem-servico': fakeRequest('ordem-servico'),
    
    // 
    kanban: fakeRequest('kanban'),

    // 
    notification: fakeRequest('notification'),
  };
};
