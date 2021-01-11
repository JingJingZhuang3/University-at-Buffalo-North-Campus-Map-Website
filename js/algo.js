  let tunnel=false;
  let shortest=true;
  let outdoor=false;

  function setTunnel(){
    tunnel=true;
    shortest=false;
    outdoor=false;
  }
  function setShortest(){
    tunnel=false;
    shortest=true;
    outdoor=false;
  }
  function setOutdoor(){
    tunnel=false;
    shortest=false;
    outdoor=true;
  }

  function BFS(dict,start,end){
    let visited=[];
    let pair={};
    let parent={};
    let queue=[];
    let ret=[];
    let index=0;
    for(var key in dict){
      parent[key]="";
      pair[key]=index;
      visited.push(false);
      index+=1;
    }

    let head=pair[start];
    let tail=pair[end];

    if(head==undefined || tail==undefined) return ret;

    visited[head]=true;
    queue.push(start);

    while(queue.length!=0){
      let size=queue.length;
      for(var j=0;j<size;j++){
        let temp=queue.shift();
        let list=dict[temp];
        for(var i of list){
          if(!visited[pair[i]]){
            queue.push(i);
            visited[pair[i]]=true;
            parent[i]=temp;
          }
          if(i==end){
            parent[i]=temp;
            let arr=[];
            let element=end;
            arr.push(element);
            while(parent[element]!=""){
              element=parent[element];
              arr.push(element);
            }
            arr.reverse();
            ret.push(arr);
          }
        }
      }
      if(visited[tail]) break;
    }
    return ret;
  }
