import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { NoteProvider } from '../../providers/note/note';

/**
 * Generated class for the EditPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-edit',
  templateUrl: 'edit.html',
})
export class EditPage {
  notes: any = [];
  form:any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public noteProv: NoteProvider, private alertCtrl: AlertController) {
    this.form = this.navParams.data
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad EditPage');
  }
  updatenote() {
    if(this.form.name == '' || this.form.body == ''){
      let alert = this.alertCtrl.create({
        title: 'Form request',
        subTitle: 'Please input name and body',
        buttons: ['Dismiss']
      });
      alert.present();
      return;
    }
    this.noteProv.update(this.form).then((data:any) => {
      console.log(data);
      if(data.status == 'success') {
        let alert = this.alertCtrl.create({
          title: 'Success',
          subTitle: 'Update Note Success',
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

