import { Injectable } from '@angular/core';
import {Router} from '@angular/router';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {BehaviorSubject, Observable} from 'rxjs';
import {map} from 'rxjs/operators';
import {User} from './authenticationUser.model';
import {environment} from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {
  private userSubject: BehaviorSubject<User>;

  constructor(private router: Router, private http: HttpClient) {
    this.userSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('user')));
  }

  public get userValue(): User {
    return this.userSubject.value;
  }

  public login(email, password): Observable<User> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.post<User>(`${environment.apiUrl}/user/auth`, { email, password }, httpOptions)
      .pipe(
        map(user => {
          localStorage.setItem('user', JSON.stringify(user[0]));
          this.userSubject.next(user[0]);
          return user[0];
        })
      );
  }

  public logout(): void {
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['login']);
  }
}
