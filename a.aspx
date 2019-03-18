<%@ Page Language="C#" AutoEventWireup="true"%>  

<!DOCTYPE html>        
<script runat="server">  
    protected void Button1_Click(object sender, System.EventArgs e)  
    {  
        //initialize a datetime variable with current datetime  
        DateTime now = DateTime.Now;  

        Label1.Text = "now : " + now.ToString();  

        //add 2 minutes to current time  
        DateTime dateAfter2Minutes = now.AddMinutes(2);  

        TimeSpan ts = dateAfter2Minutes - now;  
        //total milliseconds difference between two datetime object  
        int milliseconds = (int)ts.TotalMilliseconds;  

        Label1.Text += "<br ><br />after two minutes: ";  
        Label1.Text += dateAfter2Minutes.ToString();  

        Label1.Text += "<br ><br />smillieconds difference between to datetime object : ";  
        Label1.Text += milliseconds;  
    }  
</script>        

<html xmlns="http://www.w3.org/1999/xhtml">        
<head id="Head1" runat="server">        
    <title>c# example - datetime difference in milliseconds</title>        
</head>        
<body>        
    <form id="form1" runat="server">        
    <div>        
        <h2 style="color:MidnightBlue; font-style:italic;">        
            c# example - datetime difference in milliseconds  
        </h2>        
        <hr width="550" align="left" color="Gainsboro" />        
        <asp:Label         
            ID="Label1"         
            runat="server"        
            Font-Size="Large"      
            Font-Names="Comic Sans MS"  
            >        
        </asp:Label>        
        <br /><br />      
        <asp:Button         
            ID="Button1"         
            runat="server"         
            Text="get milliseconds difference between two datetime"        
            OnClick="Button1_Click"      
            Height="40"        
            Font-Bold="true"        
            />        
    </div>        
    </form>        
</body>        
</html>
