import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { NoteProvider } from '../../providers/note/note';

@IonicPage()
@Component({
  selector: 'page-addnote',
  templateUrl: 'addnote.html',
})
export class AddnotePage {
  form :any = {
    name : '',
    body : ''
  };

  constructor(public navCtrl: NavController, public navParams: NavParams, private noteProv: NoteProvider, private alertCtrl: AlertController) {
  }

  ionViewDidLoad() {
  }

  insertnewnote() {
    if(this.form.name == '' || this.form.body == ''){
      let alert = this.alertCtrl.create({
        title: 'Form request',
        subTitle: 'Please input name and body',
        buttons: ['Dismiss']
      });
      alert.present();
      return;
    }
    console.log(this.form);
    this.noteProv.insert(this.form).then((data:any) => {
      console.log(data);
      if(data.status == 'success') {
        let alert = this.alertCtrl.create({
          title: 'Success',
          subTitle: 'Save new Note',
          buttons: [{
            text: 'Okey',
            handler: () => {
              this.navCtrl.pop();
            }
          }]
        });
        alert.present();
      }
    });
  }
}

