import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders} from '@angular/common/http';
import {User} from "../model/user.model";
import {Observable} from "rxjs/index";
import {ApiResponse} from "../model/api.response";



@Injectable()
export class ApiService {

  constructor(private http: HttpClient) { }
  baseUrl: string = 'http://localhost/task/backend/users/';

	login(loginPayload) : Observable<ApiResponse> {
		let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
		return this.http.post<ApiResponse>(this.baseUrl + 'login', loginPayload,{headers:headers});

	}

	  createUser(user:User): Observable<ApiResponse> {
		let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
		return this.http.post<ApiResponse>(this.baseUrl + 'create', user,{headers:headers});

  }

  getUsers() : Observable<ApiResponse> {
    let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
    return this.http.get<ApiResponse>(this.baseUrl+ 'show',{headers:headers});
  }

  getUserById(id: number): Observable<ApiResponse> {
    let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
    return this.http.get<ApiResponse>(this.baseUrl +'edit/' + id,{headers:headers});
  }

  updateUser(user: User): Observable<ApiResponse> {
    let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
    return this.http.post<ApiResponse>(this.baseUrl + 'update/', user,{headers:headers});
  }

  deleteUser(id: number): Observable<ApiResponse> {
    let headers = new HttpHeaders({
			'Accept' : 'application/json'
		});
    return this.http.delete<ApiResponse>(this.baseUrl +'ajax_delete/'+ id,{headers:headers});
  }
}
