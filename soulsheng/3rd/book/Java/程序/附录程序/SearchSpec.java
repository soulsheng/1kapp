package test;
class SearchSpec{
	private String name, baseURL, numResultsSuffix;
	private static SearchSpec[] commonSpecs ={ 
		new SearchSpec("google","http://www.google.com/search?q=","&num="),
		new SearchSpec("infoseek","http://infoseek.go.com/Titles?qt=","&nh="),
		new SearchSpec("lycos","http://lycospro.lycos.com/cgi-bin/pursuit?query=","&maxhits="),
		new SearchSpec("hotbot","http://www.hotbot.com/?MT=","&DC=")};
	public SearchSpec(String name,String baseURL,String numResultsSuffix) {
		this.name = name;this.baseURL = baseURL;
		this.numResultsSuffix = numResultsSuffix;
	}
	public String makeURL(String searchString, String numResults) {
		return(baseURL + searchString + numResultsSuffix + numResults);
	}
	public String getName() {return(name);}
	public static SearchSpec[] getCommonSpecs() {return(commonSpecs);}
}