import { NgOnImit } from 'angular2/core';
//our root app component
import { Component, AfterContentInit, NgZone, OnInit} from 'angular2/core';

class ATemplate{
  constructor(public logo:string, public name: string, public description: string, public download: string, public feature?: string){}
}

class fivAccount{
  constructor(public name: string, public description: string, public url: string){}
}

@Component({
  selector: 'my-app',
  providers: [],
  templateUrl: `src/app.component.html`,
  directives: []
})
export class App implements AfterContentInit, OnInit {
  Framework7:myapp;
  Apps: ATemplate[] = [];
  KApps: fivAccount[] = [];
  OthmanApp: ATemplate[] = [];

  public myApp: any;
  public name: string;
  constructor(public ngZone: NgZone)  {
    this.name = 'تطبيقات بلس'
  }

  click(selected)
  {
    window.location.href = selected.download;
  }

  Addclick(selected)
  {
    window.location.href = selected.url;
  }

  ngAfterContentInit() {
    // contentChild is updated after the content has been checked
    console.log('AfterContentInit: ');
    this.myApp = new Framework7({
      router: true,
      material: true
    });

  }
  
  ngOnInit(){
    this.ngZone.run(()=>{
      // 🔇 🔈 📄
      this.Apps.push(new ATemplate('https://i.imgur.com/2tsQ86A.png','SCOthman','🔈 سناب شات بلس نسحة عثمان','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/scothman/scothman.plist','يجب حذف السناب الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/HQc6RLh.jpg','SCO&Spoof','🔈 سناب شات بلس نسحة عثمان + Spoof','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/scospoof.plist','يجب حذف السناب الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/PR6OLNt.png','SnapChat++','🔈 سناب شات بلس مع الإشعارات','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/sc++.plist','يجب حذف السناب الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/PR6OLNt.png','SnapChat++','🔇 📄 سناب شات بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/vip.appvalley.snapplus.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/GrmdzfB.png','EveryCord','برنامج لتصوير الشاشة','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/everycord.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/gmPjQOW.png','WhatsApp++','🔈 برنامج الواتس اب مع مميزات مثل اخفاء الظهور','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/net.whatsapp.WhatsApp.plist','يجب حذف الواتساب الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/gmPjQOW.png','WhatsApp++','🔇 📄 برنامج الواتس اب مع مميزات مثل اخفاء الظهور','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/vip.appvalley.wapp.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/GSdvfhr.png','Instagram++','🔈 انستجرام بلس مع الإشعارات','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/instagram2.plist','يجب حذف الانستجرام الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/GSdvfhr.png','Instagram++','🔇 📄 انستجرام بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/instagram.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/ElzrYXV.png','YouTube++','🔈 يوتيوب بلس مع الإشعارات','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/com.google.ios.youtube.plist','يجب حذف اليوتيوب الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/ElzrYXV.png','YouTube++','🔇 📄 يوتيوب بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/vip.appvalley.ytpp.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/eeesdOz.png','Facebook++','🔈 فيسبوك بلس مع الإشعارات','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/com.facebook.Facebook.plist','يجب حذف الفيسبوك الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/eeesdOz.png','Facebook++','🔇 📄 فيسبوك بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/vip.appvalley.fbpp.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/tZkiyyM.png','Twitter++','🔈 تويتر بلس مع الإشعارات','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/com.atebits.Tweetie2.plist','يجب حذف التويتر الأصلي'))
      this.Apps.push(new ATemplate('https://i.imgur.com/tZkiyyM.png','Twitter++','🔇 📄 تويتر بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/vip.appvalley.twpp.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/9qZAt7K.jpg','BBM2','🔇 📄 بي بي ام بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/bbm2.plist'))
      this.Apps.push(new ATemplate('https://i.imgur.com/rgbTPFP.png','BBM3','🔇 📄 بي بي ام بلس مكرر','itms-services://?action=download-manifest&url=https://cdn.appvalley.vip/ipa/bbm3.plist'))
      
      this.KApps.push(new fivAccount('xlmnxp','سناب سالم برمجة وتطوير','snapchat://add/xlmnxp'))
      this.KApps.push(new fivAccount('evil7779','سناب عبدالرحمن دعم مشاريع','snapchat://add/evil7779'))

      this.OthmanApp.push(new ATemplate('https://i.imgur.com/2tsQ86A.png','SCOthman','🔈 سناب شات بلس نسحة عثمان','itms-services://?action=download-manifest&url=https://archive.org/download/scothman_20170815_1704/scothman.plist','يجب حذف السناب الأصلي'))      
      this.OthmanApp.push(new ATemplate('https://i.imgur.com/2tsQ86A.png','SCOthman','🔇 📄 سناب شات بلس نسحة عثمان مكرر','itms-services://?action=download-manifest&url=https://archive.org/download/scothman-free/scothman2.plist'))      
    });
  }

}