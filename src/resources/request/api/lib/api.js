export default class ApiRouter {
  #baseURL;
  #routerOrigin;
  #activedMock;
  #baseMockURL;
  #routerOriginMock;

  constructor(setting) {
    this.#baseURL = setting.baseURL;
    this.#routerOrigin = setting.routerOrigin;
    this.#activedMock = setting.activedMock;
    this.#baseMockURL = setting.baseMockURL;
    this.#routerOriginMock = setting.routerOriginMock;
  }

  get url() {
    if (this.usedModk()) {
      return `${this.#baseMockURL}${this.#routerOriginMock}`;
    }

    return this.#baseURL + this.#routerOrigin;
  }

  paramRouted(parametros) {
    if (this.usedModk()) {
      return this.url;
    }
    
    let caminho = '';
    Object.keys(parametros).forEach((atributo) => {
      caminho = this.url.replace(
        new RegExp(`{${atributo}}`, 'g'),
        parametros[atributo]
      );
    });

    return caminho;
  }

  usedModk() {
    return this.#activedMock ? true : false;
  }
}
