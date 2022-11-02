function Ovni(context, imagem, imgExplosao) {
   this.context = context;
   this.imagem = imagem;
   this.x = 0;
   this.y = 0;
   this.velocidade = 0;
   this.imgExplosao = imgExplosao;
}
Ovni.prototype = {
   atualizar: function() {
      this.y += 
         this.velocidade * this.animacao.decorrido / 1000;
      
      if (this.y > this.context.canvas.height) {
         this.animacao.excluirSprite(this);
         this.colisor.excluirSprite(this);
      }
   },
   desenhar: function() {
      var ctx = this.context;
      var img = this.imagem;
      ctx.drawImage(img, this.x, this.y, img.width, img.height);
   },
   retangulosColisao: function() {
      // Estes valores vão sendo ajustados aos poucos
      var rets = 
      [ 
         {x: this.x+20, y: this.y+1, largura: 25, altura: 10},
         {x: this.x+2, y: this.y+31, largura: 10, altura: 30},
         {x: this.x+10, y: this.y+13, largura: 20, altura: 30},
      ];
      
      // Desenhando os retângulos para visualização
      /*
      var ctx = this.context;
      
      for (var i in rets) {
         ctx.save();
         ctx.strokeStyle = 'yellow';
         ctx.strokeRect(rets[i].x, rets[i].y, rets[i].largura, 
                        rets[i].altura);
         ctx.restore();
      }
      */
      
      return rets;
   },
   colidiuCom: function(outro) {
      // Se colidiu com um Tiro, os dois desaparecem
      if (outro instanceof Tiro) {
         this.animacao.excluirSprite(this);
         this.colisor.excluirSprite(this);
         this.animacao.excluirSprite(outro);
         this.colisor.excluirSprite(outro);
         
         var explosao = new Explosao(this.context, this.imgExplosao, 
                                     this.x, this.y);
         this.animacao.novoSprite(explosao);
      }
   }
}
