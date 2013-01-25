public class ch5ex20{
	static void SelectionSort(int a[]){
		int min;
		for(int j=0;j<a.length-1;j++){
			min=j;
			for(int k=j+1;k<a.length;k++){ 
  				if(a[k]<a[min]) 
  					min=k; 
  			} 
  			int t=a[min]; 
  			a[min]=a[j]; 
  			a[j]=t; 
  		} 
  	} 
	public static void main(String[]args){
		int intArray[]={1,13,3,6,10,55,98,2,87,12,34,75,33,47};
		SelectionSort(intArray);
		for(int j=0;j<intArray.length;j++)
			System.out.println(intArray[j]);
	}
}
