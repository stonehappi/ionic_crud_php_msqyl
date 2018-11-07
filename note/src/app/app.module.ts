import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';
import { SplashScreen } from '@ionic-native/splash-screen';
import { StatusBar } from '@ionic-native/status-bar';
import { HttpClientModule } from '../../node_modules/@angular/common/http';
import { HttpModule } from '@angular/http';

import { EditPage } from '../pages/edit/edit';
import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { AddnotePage } from '../pages/addnote/addnote';
import { AppCfg } from './app.config';
import { NoteProvider } from '../providers/note/note';

@NgModule({
  declarations: [
    MyApp,
    HomePage,
    AddnotePage,
    EditPage
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    HttpModule,
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    AddnotePage,
    EditPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    { provide: 'API_URL', useValue: AppCfg.API_URL },
    NoteProvider
  ]
})
export class AppModule {}
