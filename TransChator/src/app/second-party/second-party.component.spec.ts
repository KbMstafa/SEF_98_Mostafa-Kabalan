import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SecondPartyComponent } from './second-party.component';

describe('SecondPartyComponent', () => {
  let component: SecondPartyComponent;
  let fixture: ComponentFixture<SecondPartyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SecondPartyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SecondPartyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
