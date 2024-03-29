<style>
/* Transitions
*************************************/
.file-item:before,
.file-item,
.file-item .fake button i,
.remove-file:before,
.files-container {
    -webkit-transition: all .15s ease-in-out;
       -moz-transition: all .15s ease-in-out;
        -ms-transition: all .15s ease-in-out;
         -o-transition: all .15s ease-in-out;
            transition: all .15s ease-in-out;
}


/* Content
*************************************/
.section-sub-title {
    font-family: "Montserrat", Arial, Sans-serif;
    font-size: 18px;
    line-height: 1.35;
    text-transform: capitalize;
}
.text-center {
    text-align: center;
}
.dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
    cursor: pointer;
    color: #FFF;
}


/* BGs
*************************************/
.full-dark-bg {
    margin: 5% auto;
    background-color: rgba(0, 0, 0, .25);
    padding: 5%;
}

/************************************************************

    DropzoneJS Example

*************************************************************/

.inner-page .section-title {
    font-size: 28px;
    text-transform: uppercase;
    position: relative;
}
.inner-page .section-sub-title {
    margin-top: 10px;
    text-transform: uppercase;
    color: #fff;
}
.inner-page .section-sub-title:not(:first-child) {
    margin-top: 35px;
}

/* Upload files
*************************************/
.files-container {
    position: relative;
    margin: 30px 2px 15px 2px;
    background-color: rgba(0, 0, 0, .2);
}
.files-container span {
    display: block;
    text-align: center;
    padding: 50px 25px;
    font-size: 13px;
    text-transform: capitalize;
}

/*** Dropzone ***/
.files-container.hover {
    background-color: rgba(0, 0, 0, .1);
    border: 1px dashed rgba(0, 0, 0, .5);
    color: rgba(0, 0, 0, .85);
}
.files-container {
    position: relative;
    border: 1px dashed rgba(0, 0, 0, 0.25);
    min-height: auto;
}
.files-container #upload-label{
  background: rgba(231, 97, 92, 0);
  color: #fff;
  position: absolute;
  height: 115px;
  top: 20%;
  left: 0;
  right: 0;
  margin-right: auto;
  margin-left: auto;
  min-width: 20%;
  text-align: center;
  cursor: pointer;
}
.files-container.active{
  background: #fff;
}
.files-container.active #upload-label{
  background: #fff;
  color: #e7615c;
}

.files-container #upload-label i:hover {
    color: #444;
    font-size: 9.4rem;
    -webkit-transition: width 2s;
}

.files-container #upload-label span.title{
  font-size: 1em;
  font-weight: bold;
  display: block;
}

span.tittle {
    position: relative;
    top: 222px;
    color: #bdbdbd;
}

.files-container #upload-label i{
    text-align: center;
    display: block;
    color: #e7615c;
    height: 115px;
    font-size: 9.5rem;
    position: absolute;
    top: -12px;
    left: 0;
    right: 0;
    margin-right: auto;
    margin-left: auto;
}
/** Preview of collections of uploaded documents **/
.preview-container {
    position: relative;
    visibility: hidden;
}
.preview-container #previews .onyx-dropzone-info {
    display: flex;
    flex-wrap: nowrap;
    padding-top: 15px;
    width: 100%;
}
.preview-container #previews .onyx-dropzone-info > .thumb-container {
    flex: 0 0 50px;
    max-width: 50px;
    border-radius: 10px;
    overflow: hidden;
    margin-right: 17px;
}
.preview-container #previews .onyx-dropzone-info img {
    max-width: 100%;
    height: auto;
}
.preview-container #previews .onyx-dropzone-info > .details {
    position: relative;
    flex: 0 0 calc(100% - 50px);
    max-width: calc(100% - 50px);
    padding-right: 30px;
}
.preview-container #previews .onyx-dropzone-info .actions {
    position: absolute;
    right: 0;
    top: 50%;
    line-height: 1;
    transform: translateY(-50%);
}
#previews > div {
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: flex-start;
    -ms-flex-align: flex-start;
    align-items: flex-start;
}


/* Uploaded files
*************************************/
.no-files-uploaded {
    display: block;
}

.uploaded-files {
    margin-top: 10px;
    transition: all .3s ease-in-out;
}
.uploaded-files span,
.uploaded-files a {
    color: rgba(0, 0, 0, .5);
    font-size: 14px;
}
.uploaded-files a:hover {
    text-decoration: underline !important;
}
.uploaded-files i {
    position: relative;
    margin-right: 7px;
    font-size: 12px;
    color: #de1500;
}


/* Warnings
*************************************/
.last-date {
    display: block;
    margin-top: 10px;
}


/* File types
*************************************/
.thumb-container {
    position: relative;
}
div.type-pdf .thumb-container:after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-size: cover;
    background-size: 90% 100%;
    background-position: left center;
    background-repeat: no-repeat;
}
div.type-pdf .thumb-container:after {
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTYgNTYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2IDU2OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHN0eWxlIHR5cGU9InRleHQvY3NzIj4uc3Qwe2ZpbGw6I0UyNTc0Qzt9LnN0MXtmaWxsOiNCNTM2Mjk7fS5zdDJ7ZmlsbDojRkZGRkZGO308L3N0eWxlPjxnPjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zNi45LDBoLTI5QzcuMiwwLDYuNCwwLjYsNi40LDEuOVY1NWMwLDAuNCwwLjYsMSwxLjUsMWg0MC4xYzAuNywwLDEuNS0wLjYsMS41LTFWMTNjMC0wLjctMC4xLTAuOS0wLjMtMS4xTDM3LjcsMC4zQzM3LjQsMC4xLDM3LjIsMCwzNi45LDBMMzYuOSwweiIvPjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0zNy40LDAuMVYxMmgxMS45TDM3LjQsMC4xeiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0xNy4zLDM0LjNoLTEuNlYyNC4xaDIuOWMwLjQsMCwwLjksMC4xLDEuMiwwLjNjMC40LDAuMSwwLjcsMC40LDEuMSwwLjZjMC40LDAuMywwLjYsMC42LDAuNywxYzAuMywwLjQsMC4zLDAuOSwwLjMsMS4yYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMSwwLjQtMC40LDAuNy0wLjcsMWMtMC4zLDAuMy0wLjYsMC41LTEuMSwwLjZjLTAuNCwwLjEtMC45LDAuMy0xLjUsMC4zaC0xLjN2My44SDE3LjN6IE0xNy4zLDI1LjR2NGgxLjVjMC4zLDAsMC40LDAsMC42LTAuMXMwLjQtMC4xLDAuNS0wLjRjMC4xLTAuMSwwLjMtMC40LDAuNC0wLjZzMC4xLTAuNiwwLjEtMWMwLTAuMSwwLTAuNC0wLjEtMC42YzAtMC4zLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMy0wLjQtMC40LTAuNi0wLjVjLTAuMy0wLjEtMC42LTAuMy0xLTAuM2gtMS4xVjI1LjR6Ii8+PHBhdGggY2xhc3M9InN0MiIgZD0iTTMyLjIsMjguOWMwLDAuOS0wLjEsMS41LTAuMywyLjFjLTAuMSwwLjYtMC40LDEuMS0wLjYsMS41Yy0wLjMsMC40LTAuNiwwLjctMC45LDFjLTAuNCwwLjMtMC42LDAuNC0xLDAuNWMtMC40LDAuMS0wLjYsMC4xLTAuOSwwLjNjLTAuMywwLTAuNSwwLTAuNiwwaC0zLjlWMjQuMWgzYzAuOSwwLDEuNiwwLjEsMi4yLDAuNGMwLjYsMC4zLDEuMSwwLjYsMS42LDEuMWMwLjQsMC41LDAuNywxLDEsMS41QzMyLjEsMjcuOCwzMi4yLDI4LjQsMzIuMiwyOC45TDMyLjIsMjguOXogTTI3LjMsMzNjMS4xLDAsMS45LTAuNCwyLjQtMS4xYzAuNS0wLjcsMC43LTEuOCwwLjctMy4xYzAtMC40LDAtMC45LTAuMS0xLjJzLTAuMy0wLjctMC42LTEuMWMtMC4zLTAuNC0wLjYtMC42LTEuMS0wLjdjLTAuNS0wLjMtMS4xLTAuMy0xLjktMC4zaC0xVjMzTDI3LjMsMzNMMjcuMywzM3oiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzYuMiwyNS40djMuMWg0LjN2MS4xaC00LjN2NC41aC0xLjZWMjRoNi4zdjEuM2gtNC42VjI1LjR6Ii8+PC9nPjwvc3ZnPg==);
}
div.type-jpg .thumb-container:after {
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojMjZCOTlBO30uc3Qxe2ZpbGw6IzE0QTA4NTt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTIxLjMsMjQuOHY3LjhjMCwwLjUtMC4xLDAuOS0wLjMsMS4yYy0wLjIsMC4zLTAuNCwwLjYtMC43LDAuOGMtMC4zLDAuMi0wLjYsMC4zLTEsMC40Yy0wLjQsMC4xLTAuOCwwLjEtMS4yLDAuMWMtMC4yLDAtMC40LDAtMC43LTAuMWMtMC4zLDAtMC41LTAuMS0wLjgtMC4ycy0wLjYtMC4yLTAuOC0wLjNjLTAuMy0wLjEtMC41LTAuMi0wLjctMC40bDAuNy0xLjFjMC4xLDAuMSwwLjIsMC4xLDAuNCwwLjJjMC4yLDAuMSwwLjQsMC4xLDAuNiwwLjJjMC4yLDAuMSwwLjQsMC4xLDAuNiwwLjJzMC40LDAuMSwwLjYsMC4xYzAuNSwwLDAuOS0wLjEsMS4yLTAuM3MwLjQtMC41LDAuNS0xdi03LjdIMjEuM3oiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMjUuNCwzNS4xaC0xLjZWMjVoMi45YzAuNCwwLDAuOSwwLjEsMS4zLDAuMnMwLjgsMC4zLDEuMSwwLjZjMC4zLDAuMywwLjYsMC42LDAuOCwxczAuMywwLjgsMC4zLDEuM2MwLDAuNS0wLjEsMS0wLjMsMS40cy0wLjQsMC44LTAuNywxcy0wLjcsMC41LTEuMSwwLjdzLTAuOSwwLjItMS40LDAuMmgtMS4yTDI1LjQsMzUuMUwyNS40LDM1LjF6IE0yNS40LDI2LjN2NGgxLjVjMC4yLDAsMC40LDAsMC42LTAuMWMwLjItMC4xLDAuNC0wLjIsMC41LTAuM3MwLjMtMC40LDAuNC0wLjZzMC4xLTAuNiwwLjEtMWMwLTAuMiwwLTAuNC0wLjEtMC42YzAtMC4yLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjMtMC40LTAuNi0wLjVjLTAuMy0wLjEtMC42LTAuMi0xLTAuMkgyNS40eiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0zOS40LDI5Ljl2My45Yy0wLjIsMC4zLTAuNCwwLjUtMC43LDAuNnMtMC41LDAuMy0wLjgsMC40cy0wLjYsMC4yLTAuOSwwLjJjLTAuMywwLTAuNiwwLjEtMC45LDAuMWMtMC42LDAtMS4yLTAuMS0xLjctMC4zcy0wLjktMC41LTEuMy0xcy0wLjctMS0wLjktMS42Yy0wLjItMC42LTAuMy0xLjQtMC4zLTIuMnMwLjEtMS42LDAuMy0yLjJjMC4yLTAuNiwwLjUtMS4yLDAuOS0xLjZjMC40LTAuNCwwLjgtMC44LDEuMy0xYzAuNS0wLjIsMS4xLTAuMywxLjctMC4zYzAuNSwwLDEuMSwwLjEsMS41LDAuM2MwLjUsMC4yLDAuOSwwLjUsMS4zLDAuOGwtMS4xLDFjLTAuMi0wLjMtMC41LTAuNS0wLjgtMC42Yy0wLjMtMC4xLTAuNi0wLjItMC45LTAuMmMtMC4zLDAtMC43LDAuMS0xLDAuMmMtMC4zLDAuMS0wLjYsMC4zLTAuOCwwLjZjLTAuMiwwLjMtMC40LDAuNy0wLjYsMS4ycy0wLjIsMS4xLTAuMiwxLjhjMCwwLjcsMC4xLDEuMywwLjIsMS44YzAuMSwwLjUsMC4zLDAuOSwwLjUsMS4yczAuNSwwLjYsMC44LDAuN2MwLjMsMC4yLDAuNiwwLjIsMC45LDAuMmMwLjEsMCwwLjIsMCwwLjQsMGMwLjIsMCwwLjMsMCwwLjUtMC4xYzAuMiwwLDAuMy0wLjEsMC41LTAuMXMwLjMtMC4xLDAuMy0wLjJWMzFoLTEuN3YtMS4xTDM5LjQsMjkuOUwzOS40LDI5Ljl6Ii8+PC9nPjwvc3ZnPg==);
}
div.type-png .thumb-container:after {
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojODhDMDU3O30uc3Qxe2ZpbGw6IzY1OUMzNTt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTE2LjksMzUuMWgtMS42VjI1aDIuOWMwLjQsMCwwLjksMC4xLDEuMywwLjJzMC44LDAuMywxLjEsMC42YzAuMywwLjMsMC42LDAuNiwwLjgsMXMwLjMsMC44LDAuMywxLjNjMCwwLjUtMC4xLDEtMC4zLDEuNHMtMC40LDAuOC0wLjcsMXMtMC43LDAuNS0xLjEsMC43cy0wLjksMC4yLTEuNCwwLjJoLTEuMkwxNi45LDM1LjFMMTYuOSwzNS4xeiBNMTYuOSwyNi4zdjRoMS41YzAuMiwwLDAuNCwwLDAuNi0wLjFjMC4yLTAuMSwwLjQtMC4yLDAuNS0wLjNjMC4yLTAuMiwwLjMtMC40LDAuNC0wLjZzMC4xLTAuNiwwLjEtMWMwLTAuMiwwLTAuNC0wLjEtMC42YzAtMC4yLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjMtMC40LTAuNi0wLjVzLTAuNi0wLjItMS0wLjJMMTYuOSwyNi4zTDE2LjksMjYuM3oiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzAuOSwyNXYxMC4xaC0xLjdsLTQtNi45djYuOWgtMS43VjI1aDEuN2w0LDYuOVYyNUgzMC45eiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik00MC43LDI5Ljl2My45Yy0wLjIsMC4zLTAuNCwwLjUtMC43LDAuNnMtMC41LDAuMy0wLjgsMC40cy0wLjYsMC4yLTAuOSwwLjJjLTAuMywwLTAuNiwwLjEtMC45LDAuMWMtMC42LDAtMS4yLTAuMS0xLjctMC4zcy0wLjktMC41LTEuMy0xcy0wLjctMS0wLjktMS42Yy0wLjItMC42LTAuMy0xLjQtMC4zLTIuMnMwLjEtMS42LDAuMy0yLjJjMC4yLTAuNiwwLjUtMS4yLDAuOS0xLjZjMC40LTAuNCwwLjgtMC44LDEuMy0xYzAuNS0wLjIsMS4xLTAuMywxLjctMC4zYzAuNSwwLDEuMSwwLjEsMS41LDAuM2MwLjUsMC4yLDAuOSwwLjUsMS4zLDAuOGwtMS4xLDFjLTAuMi0wLjMtMC41LTAuNS0wLjgtMC42Yy0wLjMtMC4xLTAuNi0wLjItMC45LTAuMmMtMC4zLDAtMC43LDAuMS0xLDAuMmMtMC4zLDAuMS0wLjYsMC4zLTAuOCwwLjZjLTAuMiwwLjMtMC40LDAuNy0wLjYsMS4ycy0wLjIsMS4xLTAuMiwxLjhjMCwwLjcsMC4xLDEuMywwLjIsMS44YzAuMSwwLjUsMC4zLDAuOSwwLjUsMS4yczAuNSwwLjYsMC44LDAuN2MwLjMsMC4yLDAuNiwwLjIsMC45LDAuMmMwLjEsMCwwLjIsMCwwLjQsMGMwLjIsMCwwLjMsMCwwLjUtMC4xYzAuMiwwLDAuMy0wLjEsMC41LTAuMXMwLjMtMC4xLDAuMy0wLjJWMzFoLTEuN3YtMS4xTDQwLjcsMjkuOUw0MC43LDI5Ljl6Ii8+PC9nPjwvc3ZnPg==);
}
div.type-doc .thumb-container:after {
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojMDA5NkU2O30uc3Qxe2ZpbGw6IzAwNjJCMjt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTIyLjUsMjkuOGMwLDAuOC0wLjEsMS41LTAuMywyLjFzLTAuNCwxLjEtMC43LDEuNXMtMC42LDAuNy0wLjksMC45cy0wLjcsMC40LTEsMC41QzE5LjMsMzQuOSwxOSwzNSwxOC44LDM1Yy0wLjMsMC0wLjUsMC0wLjYsMGgtMy44VjI1aDNjMC44LDAsMS42LDAuMSwyLjIsMC40czEuMiwwLjYsMS42LDEuMXMwLjcsMSwxLDEuNUMyMi40LDI4LjYsMjIuNSwyOS4yLDIyLjUsMjkuOHogTTE3LjYsMzMuOWMxLjEsMCwxLjktMC40LDIuNC0xLjFzMC43LTEuNywwLjctMy4xYzAtMC40LDAtMC44LTAuMS0xLjJjLTAuMS0wLjQtMC4zLTAuOC0wLjYtMS4xcy0wLjctMC42LTEuMi0wLjhzLTEuMS0wLjMtMS45LTAuM2gtMXY3LjZDMTYsMzMuOSwxNy42LDMzLjksMTcuNiwzMy45eiIvPjxwYXRoIGNsYXNzPSJzdDIiIGQ9Ik0zMi41LDMwYzAsMC44LTAuMSwxLjYtMC4zLDIuMnMtMC41LDEuMi0wLjksMS42Yy0wLjQsMC40LTAuOCwwLjgtMS4zLDFzLTEuMSwwLjMtMS43LDAuM3MtMS4yLTAuMS0xLjctMC4zcy0wLjktMC41LTEuMy0xcy0wLjctMS0wLjktMS42cy0wLjMtMS40LTAuMy0yLjJzMC4xLTEuNiwwLjMtMi4yYzAuMi0wLjYsMC41LTEuMiwwLjktMS42YzAuNC0wLjQsMC44LTAuOCwxLjMtMXMxLjEtMC4zLDEuNy0wLjNzMS4yLDAuMSwxLjcsMC4zczAuOSwwLjUsMS4zLDFjMC40LDAuNCwwLjcsMSwwLjksMS42QzMyLjQsMjguNCwzMi41LDI5LjIsMzIuNSwzMHogTTI4LjIsMzMuOGMwLjMsMCwwLjctMC4xLDEtMC4yYzAuMy0wLjEsMC42LTAuMywwLjgtMC42YzAuMi0wLjMsMC40LTAuNywwLjYtMS4yczAuMi0xLjEsMC4yLTEuOGMwLTAuNy0wLjEtMS4zLTAuMi0xLjdjLTAuMS0wLjUtMC4zLTAuOS0wLjUtMS4ycy0wLjUtMC41LTAuOC0wLjdjLTAuMy0wLjEtMC42LTAuMi0wLjktMC4yYy0wLjMsMC0wLjcsMC4xLTEsMC4yYy0wLjMsMC4xLTAuNiwwLjMtMC44LDAuNmMtMC4yLDAuMy0wLjQsMC43LTAuNiwxLjJzLTAuMiwxLjEtMC4yLDEuOGMwLDAuNywwLjEsMS4zLDAuMiwxLjhzMC4zLDAuOSwwLjUsMS4yczAuNSwwLjUsMC44LDAuN0MyNy42LDMzLjcsMjcuOSwzMy44LDI4LjIsMzMuOHoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNNDEuNiwzNC4xYy0wLjQsMC40LTAuOCwwLjYtMS4zLDAuOGMtMC41LDAuMi0xLDAuMy0xLjUsMC4zYy0wLjYsMC0xLjItMC4xLTEuNy0wLjNzLTAuOS0wLjUtMS4zLTFzLTAuNy0xLTAuOS0xLjZzLTAuMy0xLjQtMC4zLTIuMnMwLjEtMS42LDAuMy0yLjJjMC4yLTAuNiwwLjUtMS4yLDAuOS0xLjZjMC40LTAuNCwwLjgtMC44LDEuMy0xYzAuNS0wLjIsMS4xLTAuMywxLjctMC4zYzAuNSwwLDEuMSwwLjEsMS41LDAuM2MwLjUsMC4yLDAuOSwwLjUsMS4zLDAuOGwtMS4xLDFjLTAuMi0wLjMtMC41LTAuNS0wLjgtMC42cy0wLjYtMC4yLTAuOS0wLjJjLTAuMywwLTAuNywwLjEtMSwwLjJjLTAuMywwLjEtMC42LDAuMy0wLjgsMC42Yy0wLjIsMC4zLTAuNCwwLjctMC42LDEuMnMtMC4yLDEuMS0wLjIsMS44YzAsMC43LDAuMSwxLjMsMC4yLDEuOHMwLjMsMC45LDAuNSwxLjJzMC41LDAuNSwwLjgsMC43YzAuMywwLjEsMC42LDAuMiwwLjksMC4yczAuNi0wLjEsMC45LTAuMnMwLjUtMC4zLDAuOC0wLjZMNDEuNiwzNC4xeiIvPjwvZz48L3N2Zz4=);
}
div.type-zip .thumb-container:after {
    background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1NiA1NiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTYgNTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c3R5bGUgdHlwZT0idGV4dC9jc3MiPi5zdDB7ZmlsbDojNTU2MDgwO30uc3Qxe2ZpbGw6IzNGNDg1RTt9LnN0MntmaWxsOiNGRkZGRkY7fTwvc3R5bGU+PHBhdGggY2xhc3M9InN0MCIgZD0iTTM3LDBIOEM3LjIsMCw2LjUsMC43LDYuNSwxLjlWNTVjMCwwLjMsMC43LDEsMS41LDFINDhjMC44LDAsMS41LTAuNywxLjUtMVYxM2MwLTAuNy0wLjEtMC45LTAuMy0xLjFMMzcuNiwwLjNDMzcuNCwwLjEsMzcuMiwwLDM3LDB6Ii8+PHBvbHlnb24gY2xhc3M9InN0MSIgcG9pbnRzPSIzNy41LDAuMiAzNy41LDEyIDQ5LjMsMTIgIi8+PGc+PHBhdGggY2xhc3M9InN0MiIgZD0iTTI0LjksMjV2MS4zbC00LjgsNy4ybC0wLjMsMC4yaDUuMVYzNWgtNi43di0xLjNsNC44LTcuMmwwLjMtMC4yaC01LjFWMjVIMjQuOXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMjguOSwzNWgtMS43VjI1aDEuN1YzNXoiLz48cGF0aCBjbGFzcz0ic3QyIiBkPSJNMzMsMzVoLTEuNlYyNWgyLjljMC40LDAsMC45LDAuMSwxLjMsMC4yczAuOCwwLjMsMS4xLDAuNmMwLjMsMC4zLDAuNiwwLjYsMC44LDFzMC4zLDAuOCwwLjMsMS4zYzAsMC41LTAuMSwxLTAuMywxLjRjLTAuMiwwLjQtMC40LDAuOC0wLjcsMWMtMC4zLDAuMy0wLjcsMC41LTEuMSwwLjdzLTAuOSwwLjItMS40LDAuMkgzM0wzMywzNUwzMywzNXogTTMzLDI2LjJ2NGgxLjVjMC4yLDAsMC40LDAsMC42LTAuMWMwLjItMC4xLDAuNC0wLjIsMC41LTAuM3MwLjMtMC40LDAuNC0wLjZzMC4yLTAuNiwwLjItMWMwLTAuMiwwLTAuNC0wLjEtMC42YzAtMC4yLTAuMS0wLjQtMC4zLTAuNmMtMC4xLTAuMi0wLjMtMC40LTAuNi0wLjVzLTAuNi0wLjItMS0wLjJMMzMsMjYuMkwzMywyNi4yeiIvPjwvZz48L3N2Zz4=);
}



</style>

<?php 
$day = date("j"); // Día del mes, sin ceros iniciales, de 1 a 31
$mouth = date("n"); // Mes actual en digitos sin 0 inicial, de 1 a 12
$year = date("Y"); // Año actual con 4 dígitos, ej 2013
?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>Gestor de Archivos </h3>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Haga clic y seleccione los archivos o simplemente arrastrelos hasta el recuadro.</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">	
					<div class="wrapper">
						<section class="container-fluid inner-page">
							<div class="row full-dark-bg">
								<div class="col-md-6">
									<form action="/?controller=Media&action=upload_file" class="dropzone files-container">
										<div class="fallback">
											<input name="file" type="file" multiple />
										</div>
									</form>
								</div>
								<div class="col-md-6">
									<!-- Files section -->
									<h4 class="section-sub-title"><span>Suba</span> Sus archivos</h4>
									<!-- Notes -->
									<span>Solo se admiten los tipos de archivos JPG, PNG, PDF, DOC (Word), XLS (Excel), PPT, ODT y RTF.</span>
									<span>El tamaño maximo permitido es de 25MB.</span>
									<!-- Uploaded files section -->
									<h4 class="section-sub-title"><span>Archivos</span> Subidos (<span class="uploaded-files-count">0</span>)</h4>
									<span class="no-files-uploaded">No has subido nada aún..</span>
									<!-- Preview collection of uploaded documents -->
									<div class="preview-container dz-preview uploaded-files">
										<div id="previews">
											<div id="onyx-dropzone-template">
												<div class="onyx-dropzone-info">
													<div class="thumb-container">
														<img data-dz-thumbnail />
													</div>
													<div class="details">
														<div>
															<span data-dz-name></span> <span data-dz-size></span>
														</div>
														<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
														<div class="dz-error-message"><span data-dz-errormessage></span></div>
														<div class="actions">
															<a href="#!" data-dz-remove><i class="fa fa-times"></i></a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
					
					<!-- 
					
					<SECTION>
					  <DIV id="dropzone">
						<FORM class="dropzone needsclick" id="demo-upload" action="/upload">
						  <DIV class="dz-message needsclick">    
							Drop files here or click to upload.<BR>
							<SPAN class="note needsclick">(This is just a demo dropzone. Selected 
							files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
						  </DIV>
						</FORM>
					  </DIV>
					</SECTION>-->
					<br />
                    <br />
				</div>
			</div>
		</div>
	</div>
</div>

<script>
!function ($) {
	"use strict";
	var Onyx = Onyx || {};
	Onyx = {
		/**
		 * Fire all functions
		 */
		init: function() {
			var self = this,
				obj;
			for (obj in self) {
				if ( self.hasOwnProperty(obj)) {
					var _method =  self[obj];
					if ( _method.selector !== undefined && _method.init !== undefined ) {
						if ( $(_method.selector).length > 0 ) {
							_method.init();
						}
					}
				}
			}
		},
		/**
		 * Files upload
		 */
		userFilesDropzone: {
			selector: 'form.dropzone',
			init: function() {
				var base = this,
					container = $(base.selector);
				base.initFileUploader(base, 'form.dropzone');
			},
			initFileUploader: function(base, target) {
				var previewNode = document.querySelector("#onyx-dropzone-template");
				previewNode.id = "";
				var previewTemplate = previewNode.parentNode.innerHTML;
				previewNode.parentNode.removeChild(previewNode);
				var onyxDropzone = new Dropzone(target, {
					url: ($(target).attr("action")) ? $(target).attr("action") : "/?controller=Media&action=upload_file", // Check that our form has an action attr and if not, set one here
					maxFiles: 5,
					maxFilesize: 8,
					acceptedFiles: "image/*,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf",
					previewTemplate: previewTemplate,
					previewsContainer: "#previews",
					clickable: true,
					createImageThumbnails: true,
					dictDefaultMessage: "Arrastra los archivos aquí para subirlos.", // Default: Drop files here to upload
					dictFallbackMessage: "Su navegador no admite la carga de archivos de arrastrar y soltar.", // Default: Your browser does not support drag'n'drop file uploads.
					dictFileTooBig: "El archivo es demasiado grande ({{filesize}} MiB). Tamaño máximo de archivo: {{maxFilesize}} MiB.", // Default: File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.
					dictInvalidFileType: "No puedes subir archivos de este tipo.", // Default: You can't upload files of this type.
					dictResponseError: "El servidor respondió con el código {{statusCode}}.", // Default: Server responded with {{statusCode}} code.
					dictCancelUpload: "Cancelar carga.", // Default: Cancel upload
					dictUploadCanceled: "Subida cancelada.", // Default: Upload canceled.
					dictCancelUploadConfirmation: "¿Estás seguro de que deseas cancelar esta carga?", // Default: Are you sure you want to cancel this upload?
					dictRemoveFile: "Remover archivo", // Default: Remove file
					dictRemoveFileConfirmation: null, // Default: null
					dictMaxFilesExceeded: "No puedes subir más archivos.", // Default: You can not upload any more files.
					dictFileSizeUnits: {tb: "TB", gb: "GB", mb: "MB", kb: "KB", b: "b"},
				});
				Dropzone.autoDiscover = false;
				onyxDropzone.on("addedfile", function(file) { 
					$('.preview-container').css('visibility', 'visible');
					file.previewElement.classList.add('type-' + base.fileType(file.name)); // Add type class for this element's preview
				});
				onyxDropzone.on("totaluploadprogress", function (progress) {
					var progr = document.querySelector(".progress .determinate");
					if (progr === undefined || progr === null) return;
					progr.style.width = progress + "%";
				});
				onyxDropzone.on('dragenter', function () {
					$(target).addClass("hover");
				});
				onyxDropzone.on('dragleave', function () {
					$(target).removeClass("hover");			
				});
				onyxDropzone.on('drop', function () {
					$(target).removeClass("hover");	
				});
				onyxDropzone.on('addedfile', function () {
					// Remove no files notice
					$(".no-files-uploaded").slideUp("easeInExpo");
				});
				onyxDropzone.on('removedfile', function (file) {
					console.log('target_file', file.upload_ticket);
					$.ajax({
						type: "POST",
						url: ($(target).attr("action")) ? $(target).attr("action") : "/?controller=Media&action=upload_file",
						data: {
							target_file: file.upload_ticket,
							delete_file: 1
						},
						success: function (r) {
							console.log('Response: ', r);
							/*
								r = JSON.parse(r);
								if(r.status != 'error'){
								}else{
									console.log("Error eliminando el archivo.");
									console.log(r.info);
								}
							*/
						},
					});
					// Show no files notice
					if ( base.dropzoneCount() == 0 ) {
						$(".no-files-uploaded").slideDown("easeInExpo");
						$(".uploaded-files-count").html(base.dropzoneCount());
					}
				});
				onyxDropzone.on("success", function(file, response) {
					console.log(response);
					let parsedResponse = JSON.parse(response);
					file.upload_ticket = parsedResponse.response.id;
					// Make it wait a little bit to take the new element
					setTimeout(function(){
						$(".uploaded-files-count").html(base.dropzoneCount());
						console.log('Files count: ' + base.dropzoneCount());
					}, 350);
					// Something to happen when file is uploaded
				});
			},
			dropzoneCount: function() {
				var filesCount = $("#previews > .dz-success.dz-complete").length;
				return filesCount;
			},
			fileType: function(fileName) {
				var fileType = (/[.]/.exec(fileName)) ? /[^.]+$/.exec(fileName) : undefined;
				return fileType[0];
			}
		}
	}
	$(document).ready(function() {
		Onyx.init();
	});
}(jQuery);
</script>