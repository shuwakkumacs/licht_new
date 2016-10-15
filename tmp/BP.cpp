#include<iostream>
#include<string>
#include<iomanip>
#include<cctype>
#include<vector>
#include<algorithm>
#include<queue>
#include<map>
#include<deque>
#include<stack>
#include<cmath>
#include<set>
#include<list>
#include<complex>
using namespace std;
#define FOR(i, a, b) for(int i=(a); i<(b); i++)
#define FORD(i, a, b) for(int i=(a); i>=(b); i--)
#define REP(i, n) FOR(i, 0, n)
#define ALL(a) (a).begin(), (a).end()
#define mp make_pair
#define pb push_back
#define pf push_front
#define EPS (1e-10)
#define EQ(a,b) (abs((a)-(b))<EPS)
#define EQV(a,b) ( EQ((a).real(),(b).real())&&EQ((a).imag(),(b).imag()) )
typedef long long int ll;
typedef pair<int, int> pii;
typedef complex<double> P;

int main(){
	int n;
	cin>>n;
	ll a[n];
	REP(i, n) cin>>a[i];
	ll cnt=0;

	int i=0;
	while(i!=n){
		if(a[i]>n) { cnt+=a[i]-n; a[i]=n; }
		else if(a[i]<1) { cnt+=1-a[i]; a[i]=1; }
		i++;
	}
	sort(a, a+n);
	REP(i, n){
		if(a[i]!=i+1){
			cnt+=abs(a[i]-(i+1));
			a[i]=i+1;
		}
	}
	cout << cnt << endl;
	return 0;
}
