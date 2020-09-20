import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import { Injectable } from '@angular/core';
import {Observable} from 'rxjs';
import {environment} from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(private http: HttpClient) { }

  public getAll(): Observable<any> {
    return this.http.get<any>(`${environment.apiUrl}/categories`);
  }

  public create(title: string, description: string): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.post<any>(`${environment.apiUrl}/category`, {title, description}, httpOptions);
  }

  public delete(id: number): Observable<any> {
    let params = new HttpParams();
    params = params.set('id', String(id));
    return this.http.delete<any>(`${environment.apiUrl}/category/${id}`, {params});
  }

  public update(id: number, title: string, description: string): Observable<any> {
    return this.http.put<any>(`${environment.apiUrl}/category/${id}`, {id, title, description});
  }
}
