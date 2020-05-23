import { Component,OnInit } from '@angular/core';
import { Router } from '@angular/router';
import {ApiService} from "./service/api.service";
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'test';
  logout:Boolean=false;
  constructor(
        private router: Router,
	    	private apiService: ApiService
    ){}


  ngOnInit() {
    if(!window.localStorage.getItem('token')) {
      this.logout=false;
    }else{
      this.logout=true;
    }
  }


  doLogout() {
        localStorage.removeItem('token');
        this.router.navigate(['/']).then(() => {
           console.log('logout successfully');
          });
        return true;
    }




}
